document.addEventListener('DOMContentLoaded', function () {
    const chatContainer = document.getElementById('chat-container');
    const chatScrollable = document.getElementById('chat-scrollable');
    const messageInput = document.getElementById('message');
    const imageInput = document.getElementById('image-input');
    const inputMessageSection = document.getElementById('input-message');
    const profileName = document.getElementById('profile-name');
    const profileImage = document.getElementById('profile-image');
    const sidebar = document.getElementById('sidebar-nav');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let activeConversationId = null;
    let uploadedImage = null;

    const echo = new Echo({
        broadcaster: 'pusher',
        key: 'local',
        wsHost: '127.0.0.1',
        wsPort: 6001,
        forceTLS: false,
        disableStats: true,
        enabledTransports: ['ws', 'wss']
    });

    function init() {
        updateSidebar();
        setupWebSocket();
    }

    function updateSidebar() {
        sidebar.innerHTML = '';
        conversations.forEach(conversation => {
            const lastMessage = conversation.messages.length ? conversation.messages[conversation.messages.length - 1] : null;
            const messageText = lastMessage && lastMessage.message != null ? (lastMessage.message.length > 12 ? lastMessage.message.slice(0, 12) + '...' : lastMessage.message) : '';
            const isImage = lastMessage && lastMessage["image_url"];

            const link = document.createElement('a');
            link.classList.add('nav-link', 'conversation-link');
            link.setAttribute('href', '#');
            link.setAttribute('data-conversation-id', conversation.id);
            link.setAttribute('data-user-name', conversation.user1_id === userId ? conversation["user2"].name : conversation["user1"].name);
            link.setAttribute('data-user-image', conversation.user1_id === userId ? conversation["user2"]["image_url"] : conversation["user1"]["image_url"]);

            link.innerHTML = `
                <img src="${conversation.user1_id === userId ? conversation["user2"]["image_url"] : conversation["user1"]["image_url"]}" alt="" class="rounded-circle img-fluid sidebar-image">
                <div class="ms-2 w-100">
                    <h6 class="mb-1 text-dark">
                        ${conversation.user1_id === userId ? conversation["user2"].name : conversation["user1"].name}
                    </h6>
                    <div class="text-primary mb-0 d-flex justify-content-between">
                        <p class="text-primary mb-0" id="message-text-${conversation.id}">
                            ${isImage ? '<i class="bi bi-image-fill"></i> ' + messageText : messageText}
                        </p>
                        <span class="text-secondary">${lastMessage ? new Date(lastMessage["created_at"]).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            }) : ''}</span>
                    </div>
                </div>
            `;
            sidebar.appendChild(link);

            link.addEventListener('click', function (e) {
                e.preventDefault();
                setActiveConversation(this.getAttribute('data-conversation-id'), this.getAttribute('data-user-name'), this.getAttribute('data-user-image'));
            });
        });
    }

    function setActiveConversation(conversationId, userName, userImage) {
        activeConversationId = conversationId;
        profileName.innerText = userName;
        profileImage.src = userImage;
        profileImage.classList.remove('d-none');

        const conversation = conversations.find(c => parseInt(c.id) === parseInt(activeConversationId));
        if (conversation.messages) {
            chatContainer.innerHTML = '';
            conversation.messages.forEach(message => {
                appendMessageToChat(message, message.user_id === userId);
            });
        } else {
            chatContainer.innerHTML = '<p>No messages yet.</p>';
        }
        inputMessageSection.classList.remove('d-none');
    }

    function setupWebSocket() {
        echo.channel('websocket-channel')
            .listen('.websocket-event', (data) => {
                const message = data.data;
                if (message.event === 'message') {
                    handleMessageEvent(message.data);
                } else if (message.event === 'typing') {
                    handleTypingEvent(message.data);
                }
            });
    }

    function handleMessageEvent(message) {
        const conversation = conversations.find(c => parseInt(c.id) === parseInt(message["conversation_id"]));
        if (conversation) {
            conversation.messages.push(message);
        } else {
            const newConversation = {
                id: message["conversation_id"],
                messages: [message],
                user1_id: userId,
                user2_id: message.user_id
            };
            conversations.push(newConversation);
        }
        updateSidebar();
        if (activeConversationId === message["conversation_id"]) {
            appendMessageToChat(message, message.user_id === userId);
        }
    }

    function handleTypingEvent(data) {
        if (data["userId"] === userId) return;
        const conversationLink = document.querySelector(`.conversation-link[data-conversation-id="${data["conversationId"]}"]`);
        if (conversationLink) {
            const typingIndicator = document.getElementById(`message-text-${data["conversationId"]}`);
            if (typingIndicator) {
                const originalText = typingIndicator.textContent;
                typingIndicator.textContent = `typing...`;

                setTimeout(() => {
                    typingIndicator.textContent = originalText;
                }, 1000);
            }
        }
    }

    function appendMessageToChat(message, isSender) {
        const messageElement = document.createElement('div');
        if (isSender) {
            messageElement.innerHTML = `
                <div class="d-flex flex-column align-items-end">
                    <div class="card m-0 mt-2 p-3 pt-2 pb-2 text-end d-inline-block w-auto bg-primary-light">
                        <div class="pb-0">
                            ${message["image_url"] ? `<img src="${message["image_url"]}" class="img-message img-fluid pt-1 pb-1" alt="...">` : ''}
                            <p class="text-dark m-0 text-start">${message.message ? message.message : ''}</p>
                            <p class="text-secondary m-0 text-end">${new Date(message["created_at"]).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            })}</p>
                        </div>
                    </div>
                </div>
            `;
        } else {
            messageElement.innerHTML = `
                <div class="d-flex flex-column align-items-start">
                    <div class="card m-0 mt-2 p-3 pt-2 pb-2 text-start d-inline-block w-auto bg-secondary-light">
                        <div class="pb-0">
                            ${message["image_url"] ? `<img src="${message["image_url"]}" class="img-message img-fluid pt-1 pb-1" alt="...">` : ''}
                            <p class="text-dark m-0 text-start">${message.message ? message.message : ''}</p>
                            <p class="text-secondary m-0 text-end">${new Date(message["created_at"]).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            })}</p>
                        </div>
                    </div>
                </div>
            `;
        }
        chatContainer.appendChild(messageElement);
        chatScrollable.scrollTop = chatScrollable.scrollHeight;
    }

    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const previewContainer = document.createElement('div');
            previewContainer.classList.add('image-preview-container', 'position-relative');
            previewContainer.innerHTML = `
            <div class="position-absolute d-flex flex-column align-items-end" style="bottom: 50px; right: 0;">
                <img src="${e.target.result}" class="image-preview rounded" style="max-width: 25vw; max-height: 25vw; border: 2px solid #ccc;" alt="Image Preview">
                <button class="remove-image-preview btn btn-sm btn-secondary p-2 pt-1 pb-1" style="position: absolute; top: 0; right: 0;">x</button>
            </div>
        `;
            inputMessageSection.appendChild(previewContainer);

            const removeButton = previewContainer.querySelector('.remove-image-preview');
            removeButton.addEventListener('click', function () {
                uploadedImage = null;
                previewContainer.remove();
            });

            uploadedImage = file;
        };
        reader.readAsDataURL(file);
    }

    document.getElementById('send-message').addEventListener('click', function () {
        const messageText = messageInput.value;
        if (messageText.trim() === '' && !uploadedImage) return;

        const formData = new FormData();
        formData.append('message', messageText);
        if (uploadedImage) {
            formData.append('image', uploadedImage);
        }

        sendMessage(formData);
    });

    document.getElementById('upload-image').addEventListener('click', function () {
        imageInput.click();
    });

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            showImagePreview(file);
        }
    });

    messageInput.addEventListener('input', function () {
        if (activeConversationId) {
            sendTypingStatus(true);
        }
    });

    function sendMessage(data) {
        fetch(`/conversations/${activeConversationId}/messages`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: data
        })
            .then(response => response.json())
            .then(() => {
                messageInput.value = '';
                const previewContainer = document.querySelector('.image-preview-container');
                if (previewContainer) {
                    previewContainer.remove();
                }
                uploadedImage = null;
            });
    }

    function sendTypingStatus(isTyping) {
        if (!activeConversationId) return;

        fetch(`/conversations/${activeConversationId}/typing`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({isTyping: isTyping})
        }).then();
    }

    init();
});

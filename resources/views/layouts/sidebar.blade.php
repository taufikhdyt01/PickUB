<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            @if(isset($conversations))
                @foreach($conversations as $conversation)
                    @php
                        $lastMessage = $conversation->messages->isEmpty() ? null : $conversation->messages->last();
                        $messageText = $lastMessage ? $lastMessage->message : 'No messages yet';
                        if ($lastMessage && str_word_count($messageText) > 12) {
                            $messageText = implode(' ', array_slice(explode(' ', $messageText), 0, 12)) . '...';
                        }
                        $isImage = $lastMessage && $lastMessage->image_url;
                    @endphp
                    <a class="nav-link conversation-link" data-conversation-id="{{ $conversation->id }}"
                       data-user-name="{{ $conversation->user1_id === Auth::id() ? $conversation->user2->name : $conversation->user1->name }}"
                       data-user-image="{{ $conversation->user1_id === Auth::id() ? $conversation->user2->image_url : $conversation->user1->image_url }}">
                        <img src="{{ $conversation->user1_id === Auth::id() ? $conversation->user2->image_url : $conversation->user1->image_url }}" alt="" class="rounded-circle img-fluid sidebar-image">
                        <div class="ms-2 w-100">
                            <h6 class="mb-1 text-dark">
                                {{ $conversation->user1_id === Auth::id() ? $conversation->user2->name : $conversation->user1->name }}
                            </h6>
                            <div class="text-primary mb-0 d-flex justify-content-between">
                                <p class="text-primary mb-0" id="message-text-{{ $conversation->id }}">
                                    @if($isImage)
                                        <i class="bi bi-image-fill"></i> {{ $messageText }}
                                    @else
                                        {{ $messageText }}
                                    @endif
                                </p>
                                @if($lastMessage)
                                    <span class="text-secondary">{{ $lastMessage->created_at->format('g:i A') }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    <hr class="m-1">
                @endforeach
            @endif
        </li>
    </ul>
</aside>

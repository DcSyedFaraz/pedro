<template>
    <div class="message-main">

        <Head title="Chat Room" />
        <div class="py-2 border-bottom d-block d-lg-block chat-header">
            <div class="d-flex align-items-center py-1">
                <div class="position-relative">
                    <!-- <img v-if="chat.product.image?.path" :src="'/storage/' + chat.product.image.path"
                        class="rounded-circle mr-1 chat-dp" alt="Product image for {{ chat.product.name }}" /> -->
                </div>
                <div class="flex-grow-1 username-main pl-3 mt-2">

                    <div>
                        <h4>{{ otherUser.name }}</h4>
                        <p>{{ otherUser.email }}</p>
                    </div>
                </div>
                <div class="all-btns">
                    <!-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Block</a></li>
                            <li><a class="dropdown-item" href="#">Report</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="position-relative" ref="chatMessages">
            <div class="chat-messages p-4">
                <div v-for="message in messages" :key="message.id" :class="{
                    chat_message_left: message.sender.id !== currentUser.id,
                    chat_message_right: message.sender.id === currentUser.id,
                    'message-sending': message.status === 'sending',
                    'message-sent': message.status === 'sent'
                }" class="pb-4">

                    <div v-if="message.sender.id !== currentUser.id">
                        {{ message.sender.name }}
                    </div>

                    <div :class="{
                        chat_opp: message.sender.id !== currentUser.id,
                        chat_opp1: message.sender.id === currentUser.id,
                    }">
                        {{ message.message }}
                    </div>
                </div>
                <div class="message-sending chat_message_left" v-if="typing">

                    <div class="chat_opp">
                        typing...
                    </div>
                </div>
            </div>
        </div>

        <div class="message-box">
            <form @submit.prevent="sendMessage">
                <div class="input-group">

                    <input type="text" @input="notifyTyping" v-model="newMessage" class="form-control"
                        placeholder="Type your message">
                    <button class="send-btn" type="submit"><i class="fa-regular fa-location-arrow-up"></i></button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import axios from 'axios';


export default {
    props: {
        chat: {
            type: Object,
            required: true,
        },
        currentUser: {
            type: Object,
            required: true,
        },
        otherUser: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            newMessage: '',
            messages: [...this.chat.messages],
            sendingMessages: [],
            typing: false,
            isTyping: false,
        };
    },
    computed: {
        // bothInterested() {
        //     return this.isInterested && this.otherUserInterested;
        // }
    },

    methods: {
        notifyTyping() {
            if (!this.isTyping) {
                this.isTyping = true;
                window.Echo.private(`chat.${this.chat.id}`)
                    .whisper('typing', { userId: this.currentUser.id });

                // Reset typing status after 3 seconds of inactivity
                setTimeout(() => {
                    this.isTyping = false;
                }, 3000);
            }
        },
        scrollToBottom() {
            const container = this.$refs.chatMessages;
            container.scrollTop = container.scrollHeight;
        },
        async interested() {
            if (this.isInterested) {
                Swal.fire('Already interested!', 'You have already expressed interest.', 'info');
                return;
            }

            const result = await Swal.fire({
                title: 'Are you interested?',
                text: 'Do you want to express interest in this product?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, interested',
                cancelButtonText: 'Cancel'
            });

            if (result.isConfirmed) {
                try {
                    // Send interest to the server
                    await axios.post(route('chats.interest.store', { chat: this.chat.id }));

                    this.isInterested = true;

                    // Notify the other user via Echo
                    window.Echo.private(`chat.${this.chat.id}`)
                        .whisper('InterestExpressed', { userId: this.currentUser.id });

                    Swal.fire('Interested!', 'You have expressed interest.', 'success');
                } catch (error) {
                    if (error.response.data.bothInterested) {

                        Swal.fire('Already interested!', 'You have already expressed interest.', 'info');
                    }
                    else {

                        console.error('Error expressing interest:', error);
                        Swal.fire('Error', 'There was a problem expressing your interest.', 'error');
                    }
                }
            }
        },
        sendMessage() {
            if (this.newMessage.trim() === '') return;

            const tempMessage = {
                id: Date.now(), // Temporary ID
                message: this.newMessage,
                sender: this.currentUser, // Set the sender as the current user
                status: 'sending', // Mark message as sending
            };
            this.isTyping = false;

            // Push message into the array
            this.messages.push(tempMessage);
            const messageText = this.newMessage;
            this.newMessage = '';
            this.$nextTick(() => this.scrollToBottom());

            axios.post(route('chats.messages.store', { chat: this.chat.id }), {
                message: messageText,
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => {
                    const sentMessage = this.messages.find(msg => msg.id === tempMessage.id);
                    if (sentMessage) {
                        sentMessage.status = 'sent'; // Update status on successful send
                    }
                    this.$nextTick(() => this.scrollToBottom());
                    this.$emit('message-sent', response.data.message);
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                });
        },

        addMessage(message) {
            if (message.sender.id === this.currentUser.id) {
                return;
            }
            this.messages.push(message);
            this.$nextTick(() => this.scrollToBottom());
            console.log(message);

            this.$emit('message-received', message);
        },
        setupEcho() {
            if (window.Echo) {
                // Listen for new messages
                window.Echo.private(`chat.${this.chat.id}`)
                    .listen('.MessageSent', (e) => {
                        console.log('MessageSent event received:', e);
                        this.typing = false;
                        this.addMessage(e);
                    })
                    .listenForWhisper('typing', (e) => {
                        console.log('typing event received:', e, this.currentUser);
                        if (e.userId != this.currentUser.id) {
                            this.typing = true;
                            this.scrollToBottom();
                            setTimeout(() => this.typing = false, 3000); // Reset after 2 seconds
                        }
                    });
            } else {
                console.error('Laravel Echo is not initialized.');
            }
            console.log(window.Echo.private(`chat.${this.chat.id}`));
            // Check if Echo is instantiated correctly
        },
        leaveEcho() {
            if (window.Echo) {
                window.Echo.leave(`private-chat.${this.chat.id}`);
            }
        },

    },
    mounted() {
        this.setupEcho();
        this.$nextTick(() => this.scrollToBottom());
        this.$emit('chat-viewed', this.chat.id);
    },
    beforeUnmount() {
        this.leaveEcho();
    },
};
</script>

<style scoped>
.message-sending {
    opacity: 0.5;
    color: gray;
}

.message-sent {
    opacity: 1;
    color: black;
}

.blurred {
    filter: blur(5px);
    transition: filter 0.3s ease;
}
</style>

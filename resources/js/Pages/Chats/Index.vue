<template>
    <div class="chat-index-page">
        <div class="container">
            <h1>Your Chats</h1>
            <div class="chat-list">
                <div v-for="chat in chatsList" :key="chat.id" class="chat-item">
                    <Link :href="route('chats.show', chat.id)" class="chat-link">
                    <div class="chat-details">
                        <!-- Optional: User or product image -->
                        <div class="chat-info">
                            <h3>{{ chat.with_user.name }}</h3>
                            <p v-if="chat.product">Regarding: {{ chat.product.name }}</p>
                            <p v-if="chat.last_message">{{ chat.last_message.message }}</p>
                        </div>
                        <div class="chat-meta">
                            <span>{{ formatDate(chat.last_message?.created_at) }}</span>
                            <span v-if="chat.unread_count > 0" class="badge">{{ chat.unread_count }}</span>
                        </div>
                    </div>
                    </Link>
                </div>
                <div v-if="chatsList.length === 0" class="no-chats">
                    <p>You have no chats yet.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';


export default {

    props: {
        chats: {
            type: Array,
            required: true,
        },
        auth: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const chatsList = ref([...props.chats]);

        // Function to format dates
        const formatDate = (dateString) => {
            if (!dateString) return '';
            const options = {
                year: 'numeric', month: 'short', day: 'numeric',
                hour: '2-digit', minute: '2-digit'
            };
            return new Date(dateString).toLocaleDateString(undefined, options);
        };

        // Initialize Laravel Echo for real-time updates
        onMounted(() => {


            // Subscribe to each chat's private channel
            props.chats.forEach(chat => {
                window.Echo.private(`chat.${chat.id}`)
                    .listen('.MessageSent', (e) => {
                        // Update the last_message of the chat
                        const chatIndex = chatsList.value.findIndex(c => c.id === chat.id);
                        if (chatIndex !== -1) {
                            // Update the chat's last_message
                            chatsList.value[chatIndex].last_message = {
                                message: e.message.message,
                                created_at: e.message.created_at,
                            };

                            // Increment unread_count if the user is not viewing this chat
                            // Assuming you have a way to know which chat is currently open
                            // For simplicity, let's assume none are open from this component
                            chatsList.value[chatIndex].unread_count += 1;
                        }
                    });
            });

            // Listen for new chats initiated
            window.Echo.private(`user.${props.auth.user.id}`)
                .listen('.ChatInitiated', (e) => {
                    // Add the new chat to the chatsList
                    chatsList.value.unshift({
                        id: e.chat.id,
                        with_user: e.chat.with_user,
                        product: e.chat.product,
                        last_message: null, // No messages yet
                        unread_count: 0,
                    });

                    // Subscribe to the new chat's private channel
                    window.Echo.private(`chat.${e.chat.id}`)
                        .listen('.MessageSent', (messageEvent) => {
                            const chatIdx = chatsList.value.findIndex(c => c.id === e.chat.id);
                            if (chatIdx !== -1) {
                                chatsList.value[chatIdx].last_message = {
                                    message: messageEvent.message.message,
                                    created_at: messageEvent.message.created_at,
                                };
                                chatsList.value[chatIdx].unread_count += 1;
                            }
                        });
                });
        });

        // Watch for prop changes and update chatsList accordingly
        watch(() => props.chats, (newChats) => {
            chatsList.value = [...newChats];
        });

        return {
            chatsList,
            formatDate,
        };
    },
};
</script>
<style scoped>
.chat-index-page {
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
}

.chat-list {
    margin-top: 20px;
}

.chat-item {
    margin-bottom: 10px;
}

.chat-link {
    display: block;
    text-decoration: none;
    color: inherit;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.chat-link:hover {
    background-color: #f9f9f9;
}

.chat-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-info h3 {
    margin: 0;
    font-size: 1.2em;
}

.chat-info p {
    margin: 5px 0 0 0;
    color: #555;
}

.chat-meta {
    display: flex;
    align-items: center;
}

.chat-meta span {
    font-size: 0.9em;
    color: #999;
    margin-left: 10px;
}

.badge {
    background-color: red;
    color: white;
    border-radius: 12px;
    padding: 2px 8px;
    font-size: 0.8em;
    margin-left: 5px;
}
</style>

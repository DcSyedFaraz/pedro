<!-- resources/js/Components/ChatSidebar.vue -->
<template>
    <div>

        <Head title="Chat Room" />
        <i class="fa-solid fa-bars" id="close-bar"></i>

        <a :href="route('chats.index')" class="market-d">
            <i class="fas fa-shopping-cart mr-2"></i> &nbsp;
            Dashboard
        </a>

        <Head title="Users" />
        <div v-for="chat in chats" :key="chat.id" :class="['chat-item', { 'current-chat': chat.id === currentChatId }]">
            <Link :href="route('chats.show', chat.id)" class="user-div">
            <div class="d-flex align-items-center">
                <!-- <img v-if="chat.product.image?.path" :src="'/storage/' + chat.product.image.path"
                    class="rounded-circle mr-1" alt="Vanessa Tucker"> -->
                <div class="content-inner">
                    <h3 v-if="chat.with_user">{{ chat.with_user.name }}</h3>
                    <p v-if="chat.last_message" class="d-flex justify-between">
                        <span v-if="chat.last_message.message?.message">
                            {{ chat.last_message.message.message }}
                        </span>
                        <span v-else>
                            {{ chat.last_message.message }}
                        </span>
                        <span v-if="chat.unread_count > 0" class="badge bg-danger">{{ chat.unread_count }}</span>
                    </p>
                </div>
            </div>
            </Link>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        chats: {
            type: Array,
            required: true,
        },
        currentChatId: {
            type: [Number, String], // Depending on how your IDs are defined
        },
    },
    methods: {
        truncateText(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            }
            return text;
        }
    }
};
</script>
<!-- resources/js/Components/ChatSidebar.vue -->
<style scoped>
.chat-item {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.current-chat {
    border: 2px solid #f0f8ff;
    /* Or any style you prefer */
    /* Additional styles to highlight the current chat */
}
</style>

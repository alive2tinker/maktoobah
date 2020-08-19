<template>
    <div class="container">
        <div class="card" v-if="chatObject">
            <div class="card-body" id="chat-container">
                <div :class="{'bubble-speech': true,
                          'sender-message': isSender(message),
                          'receiver-message': !isSender(message)}"
                     v-for="(message, index) in chatObject.messages" :key="index">
                    {{ message.text }}
                </div>
            </div>
            <div class="card-footer">
                <div class="input-group mb-3">
                    <textarea rows="1.5" class="form-control"
                              v-model="messageText"></textarea>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"
                                type="button" @click="sendMessage"
                                id="button-addon2">{{ $t('strings.send') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'ChatComponent',
        props: ['chat','user'],
        data(){
            return {
                messageText: '',
                chatObject: null,
                loadingMessages: true,
                sendingAMessage: false,
            }
        },
        created(){
            Echo.private(`App.User.${this.user}`)
                .listen('.message.sent', (e) => {
                    this.chatObject.messages.push(e.message);
                })
        },
        mounted() {
            this.getChat();
        },
        methods:{
            getChat: function(){
                axios.get(`/chats/chatResource/${this.chat}`).then((response) => {
                    this.chatObject = response.data;
                })
            },
            scrollEnd: function(){
                var container = this.$el.querySelector('#chat-container');
                container.scrollTop = container.scrollHeight;
            },
            sendMessage: function () {
                var formData = new FormData();
                formData.append('message_text', this.messageText);
                formData.append('chat_id', this.chat);
                this.sendingAMessage = true;
                axios.post(`/messages/${this.chat}`, formData).then((response) => {
                    this.sendingAMessage = false;
                    this.chatObject.messages.push(response.data);
                    this.messageText = '';
                });
            },
            isSender: function(message){
                return this.chatObject.otherEnd.id !== message.userID;
            },
        },
        updated() {
            this.scrollEnd();
        },
    }
</script>
<style scoped>
#chat-container{
    height: 75vh;
    overflow: hidden;
    overflow-y: scroll;
}
.bubble-speech{
    width: 50%;
    padding: 1em;
    border-radius: 1em;
    display: block;
    clear: both;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}
.sender-message{
    background: #e4e4e4;
    float: right !important;
}
.receiver-message{
    float: left !important;
    background: #3ea1ec;
    color: white;
}
</style>

<template>
    <b-nav-item-dropdown @click="readNotifications">
        <template v-slot:button-content>
            <i class="fas fa-bell" @click="readNotifications"><i class="badge badge-danger" v-if="unreadNotifications > 0">{{ unreadNotifications }}</i></i>
        </template>
        <div v-if="notifications.length > 0">
            <b-dropdown-item :href="`${notification.data.link}`" v-for="(notification, index) in notifications"
                             :key="index">{{ notification.data.message }}</b-dropdown-item>
            <b-dropdown-divider></b-dropdown-divider>
            <b-dropdown-item href="/users/all_notifications">{{ $t('strings.view_all')}}</b-dropdown-item>
        </div>
        <div v-else>
            <b-dropdown-item href="#">{{ $t('strings.no_data')}}</b-dropdown-item>
        </div>
    </b-nav-item-dropdown>
</template>

<script>
export default {
    name: "NotificationComponent",
    props: ['user'],
    data(){
        return {
            notifications: [],
            isLoading: true
        }
    },
    computed: {
        unreadNotifications:{
            set: function (newValue) {
                this.unreadNotifications = newValue
            },

            get: function(){
                return this.notifications.filter((s) => s.read_at === null).length;
            }
        }
    },
    mounted() {
        this.fetchNotifications();

        Echo.private(`App.User.${this.user}`)
            .notification((notification) => {
                this.notifications.push({data: {message: notification.message, link: notification.link}, read_at: null, id: notification.id})
            });
    },
    methods: {
        fetchNotifications: function(){
            axios.get('/users/notifications').then((response) => {
                this.notifications = response.data;
            })
        },
        readNotifications: function(){
            if(this.unreadNotifications > 0)
                axios.get('/users/readNotifications').then((response) => {
                    this.unreadNotifications = 0;
                })
        }
    }
}
</script>

<style scoped>

</style>

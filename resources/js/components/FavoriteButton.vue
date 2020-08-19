<template>
        <button class="btn btn-link" @click="takeAction" :disabled="workingOnRequest">
            <i v-bind:class="{'fas text-danger fa-heart' : userIsFavorited,
             'far text-danger fa-heart': !userIsFavorited}"></i>{{ this.favoriteCount }}</button>
</template>

<script>
    export default {
        name: "FavoriteButton",
        props: ['user'],
        data(){
            return {
                userIsFavorited: false,
                favoriteCount: 0,
                workingOnRequest: false
            }
        },
        mounted() {
            this.checkFavorite();
        },
        methods: {
            checkFavorite: function () {
                axios.get(`favorites/isFavorited/${this.user}`)
                .then((response) => {
                    this.favoriteCount = response.data.count;
                    if(response.data.result === true){
                        this.userIsFavorited = true;
                    }
                })
            },
            takeAction: function(e) {
                e.preventDefault();
                this.workingOnRequest = true;
                if(this.userIsFavorited){
                    axios.delete(`favorites/${this.user}`).then((response) => {
                        this.userIsFavorited = false;
                        this.checkFavorite();
                        this.workingOnRequest = false;
                    });
                }else{
                    var fd = new FormData();
                    fd.append('favorable_id', this.user);
                    axios.post('/favorites', fd).then((response) => {
                        this.userIsFavorited = true;
                        this.checkFavorite()
                        this.workingOnRequest = false;
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>

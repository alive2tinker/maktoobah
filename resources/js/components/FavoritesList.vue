<template>
    <div class="container">
        <div class="list-group" v-if="favorites.length > 0">
            <div class="list-group-item list-group-item-action" v-for="(favorite, index) in favorites" :key="index">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><a :href="`/users/${favorite.favorable.id}`">{{ favorite.favorable.name}}</a></h5>
                </div>
                <p class="mb-1">{{ favorite.favorable.details.substring(0,160)}}</p>
                <small>
                    <ul class="list-unstyled d-flex">
                        <li><FavoriteButton :user="favorite.favorable.id"></FavoriteButton></li>
                    </ul>
                </small>
            </div>
        </div>
        <div class="list-group" v-else>
            <div class="list-group-item list-group-item-action">
                <h4 class="text-center">{{ $t('strings.no_data')}}</h4>
            </div>
        </div>
    </div>
</template>

<script>
import FavoriteButton from "./FavoriteButton";
export default {
    name: "FavoritesList.vue",
    components:{
        FavoriteButton
    },
    data(){
        return {
            favorites: [],
            loadingFavorites: true,
            nextPage: '',
            prevPage: ''
        }
    },
    mounted() {
        this.fetchFavorites();
    },
    methods: {
        fetchFavorites: function(){
            axios.get('/favorites/list').then((response) => {
                console.log(response.data.data);
                this.favorites.push(...response.data.data);
                this.nextPage = response.data.links.next;
                this.prevPage = response.data.links.prev;
            })
        }
    }
}
</script>

<style scoped>

</style>

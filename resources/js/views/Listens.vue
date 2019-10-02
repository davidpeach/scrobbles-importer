<template>
    <div class="card">
        <div class="card-header">Listens</div>

        <div class="card-body">

            <ul>
                <li v-for="listen in listens" v-text="listen.song.title + ' by ' + listen.song.album.artist.name"></li>
            </ul>

        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                listens: []
            }
        },

        mounted: function() {
            axios.get('/api/listens').then((response) => {
                this.listens = response.data;
                console.log(this.listens)
            })
        }
    }
</script>
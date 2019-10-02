<template>
    <div class="card">
        <div class="card-header">Albums</div>

        <div class="card-body">

            <ul>
                <li v-for="album in albums" v-text="album.title + ' by ' + album.artist.name"></li>
            </ul>

        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                albums: []
            }
        },

        mounted: function() {
            axios.get('/api/albums').then((response) => {
                this.albums = response.data;
                console.log(this.albums)
            })
        }
    }
</script>
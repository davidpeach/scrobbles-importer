<template>
    <div class="card">
        <div class="card-header">Artists</div>

        <div class="card-body">

            <ul>
                <li v-for="artist in artists" v-text="artist.name"></li>
            </ul>

        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                artists: []
            }
        },

        mounted: function() {
            axios.get('/api/artists').then((response) => {
                this.artists = response.data;
            })
        }
    }
</script>
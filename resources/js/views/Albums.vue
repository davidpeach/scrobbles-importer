<template>
    <div class="card">
        <div class="card-header">Albums</div>

        <div class="card-body">

            <ul>
                <li v-for="album in albums" v-text="album.title"></li>
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
            })
        }
    }
</script>
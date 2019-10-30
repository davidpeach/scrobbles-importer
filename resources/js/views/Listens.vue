<template>
    <div class="card">
        <div class="card-header">Listens</div>

        <div class="card-body">
            <ul>
                <li v-for="listen in listens" v-text="listen.title + ' by ' + listen.artist + ' - ' + listen.date"></li>
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

                let dates = response.data.data;

                for (let [key, songsbyDate] of Object.entries(dates)) {

                    for (let [key, listen] of Object.entries(songsbyDate)) {
                        this.listens.push(listen)
                    }

                }
            })
        }
    }
</script>
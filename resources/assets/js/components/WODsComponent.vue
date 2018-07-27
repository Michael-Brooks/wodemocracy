<template>
    <div>
        <div class="row" v-for="wod in wods.data">
            <div class="col-12 pt-3 pb-3" v-for="workout in wod.workouts">
                <div class="card" v-if="workout.won === 1">
                    <h5 class="card-header">WOD {{ wod.workout_date | moment }}</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ workout.title }}</h5>
                        <vue-markdown :source="workout.details"></vue-markdown>
                    </div>
                </div>
            </div>
        </div>

        <pagination :data="wods" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    import VueMarkdown from 'vue-markdown';
    import moment from 'moment';

    export default {
        data () {
            return {
                wods: {}
            }
        },
        filters: {
            moment: function (date) {
                return moment(date).format('DD/MM/Y');
            }
        },
        mounted () {
            this.getResults();
        },
        methods: {
            getResults(page = 1) {
                axios.get('/api/WODs?page=' + page)
                    .then(response => (this.wods = response.data));
            }
        },
        components: {
            VueMarkdown,
        }
    }
</script>
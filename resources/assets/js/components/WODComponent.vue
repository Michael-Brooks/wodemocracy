<template>
    <div>
        <div class="row mb-5" v-for="workout in wod[1]">
            <div class="col-12 pt-3 pb-3">
                <div class="card">
                    <h5 class="card-header">{{ workout.title }} - Created by {{ workout.user.name }}</h5>
                    <div class="card-body">
                        <vue-markdown>{{ workout.details }}</vue-markdown>
                    </div>
                    <div class="card-footer">
                        <vote :id="workout.id" :auth="auth" :user="user" :upvotes-count="workout.upvotes_count" :downvotes-count="workout.downvotes_count"></vote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueMarkdown from 'vue-markdown';
    import moment from 'moment';

    export default {
        data () {
            return {
                wod: {},
            }
        },
        props: {
            id: Number,
            auth: Number,
            user: Number,
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
            getResults() {
                axios.get('/api/WODs/' + this.id)
                    .then(response => (this.wod = response.data));
            },
        },
        components: {
            VueMarkdown,
        },
    }
</script>
<template>
    <div class="row">
        <div class="col-md-1">
            <button class="btn btn-block btn-info" :disabled="auth === 0" v-on:click="setVote(id, 1, 0)">
                <i class="fas fa-arrow-circle-up"></i>
                <span class="ml-2">{{ count.upvotes_count }}</span>
            </button>
        </div>
        <div class="col-md-1">
            <button class="btn btn-block btn-info" :disabled="auth === 0" v-on:click="setVote(id, 0, 1)">
                <i class="fas fa-arrow-circle-down"></i>
                <span class="ml-2">{{ count.downvotes_count }}</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                count: {
                    upvotes_count: this.upvotesCount,
                    downvotes_count: this.downvotesCount,
                }
            }
        },
        props: {
            id: Number,
            auth: Number,
            user: Number,
            upvotesCount: Number,
            downvotesCount: Number,
        },
        methods: {
            setVote(id, upvote = 0, downvote = 0) {
                axios.post('/api/vote/' + id, {
                    upvote: upvote,
                    downvote: downvote,
                    user: this.user,
                })
                    .then(response => {
                        this.count = response.data
                    });
            },
        },
    }
</script>
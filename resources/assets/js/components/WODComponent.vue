<template>
    <div>
        <div class="row mb-5" v-for="workout in wod.workouts">
            <div class="col-12 pt-3 pb-3">
                <div class="card">
                    <h5 class="card-header">{{ workout.title }} - Created by {{ workout.user.name }}</h5>
                    <div class="card-body">
                        <vue-markdown>{{ workout.details }}</vue-markdown>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-1">
                                <button class="btn btn-block btn-info" disabled>
                                    <i class="fas fa-arrow-circle-up"></i>
                                    <span class="ml-2">{{ upvoteCount }}</span>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-block btn-info" disabled>
                                    <i class="fas fa-arrow-circle-down"></i>
                                    <span class="ml-2">{{ downvoteCount }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!--@auth
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-1">
                        <form action="/vote/{{ $workout->id }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="vote" value="1">
                                <button class="btn btn-block btn-info">
                                    <i class="fas fa-arrow-circle-up"></i>
                                    <span class="ml-2">{{ $workout->upvotes_count }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1">
                        <form action="/vote/{{ $workout->id }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="vote" value="-1">
                                <button class="btn btn-block btn-info">
                                    <i class="fas fa-arrow-circle-down"></i>
                                    <span class="ml-2">{{ $workout->downvotes_count }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::id() === $workout->user_id)
                    <div class="col-md-3 offset-md-7 col-sm-12">
                        <form action="/workout/{{ $workout->id }}" id="delete_form" method="post">
                            @method('DELETE')
                            @csrf
                            <div class="form-group">
                                <confirm-delete-button title="{{ __('Delete Workout') }}" message="{{ __('Are you sure?') }}"></confirm-delete-button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @else
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-1">
                        <button class="btn btn-block btn-info" disabled>
                            <i class="fas fa-arrow-circle-up"></i>
                            <span class="ml-2">{{ $workout->upvotes_count }}</span>
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-block btn-info" disabled>
                            <i class="fas fa-arrow-circle-down"></i>
                            <span class="ml-2">{{ $workout->downvotes_count }}</span>
                        </button>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endforeach-->

<script>
    import VueMarkdown from 'vue-markdown';
    import moment from 'moment';

    export default {
        data () {
            return {
                wod: {}
            }
        },
        props: {
            id: Number,
        },
        computed: {
          upvoteCount: function () {
              let total = 0;
              this.wod.workouts.forEach(function (workout) {
                  workout.votes.forEach(function (vote) {
                      if(vote.upvote) {
                          total += vote.upvote;
                      }
                  })
              });

              return total;
          },
          downvoteCount: function () {
              let total = 0;
              this.wod.workouts.forEach(function (workout) {
                  workout.votes.forEach(function (vote) {
                      if(vote.downvote) {
                          total += vote.downvote;
                      }
                  })
              });

                return total;
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
            getResults() {
                axios.get('/api/WODs/' + this.id)
                    .then(response => (this.wod = response.data));
            }
        },
        components: {
            VueMarkdown,
        }
    }
</script>
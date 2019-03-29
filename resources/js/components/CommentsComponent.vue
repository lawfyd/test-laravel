<template>
    <div class="row">
        <transition-group name="list" tag="div" class="col-lg-12">
            <div class="col-xs-12" v-for="(comment, index) in comments" v-bind:key="index">
                <p><b>{{comment.author}}</b></p>
                <p>{{comment.content}}</p>
                <p>{{ comment.created_at}}</p>
                <hr/>
            </div>
        </transition-group>
        <br>
        <div class="col-md-6">
            <form class="comment-form" @submit.prevent="addComment">
                <div class="form-group">
                    <label for="author">Your name</label>
                    <input type="text" class="form-control" id="author" v-model="author" placeholder="John Wu">
                    <small id="authorHelp" class="text-danger" v-text="errors.get('author')"></small>
                </div>

                <div class="form-group">
                    <label for="content">Message</label>
                    <textarea class="form-control" id="content" rows="3" v-model="content"></textarea>
                    <small id="messageHelp" class="text-danger" v-text="errors.get('message')"></small>
                </div>
                <input type="submit" value="Send" class="btn btn-primary">
            </form>
        </div>
    </div>
</template>

<script>
    class Errors {
        constructor() {
            this.errors = {};
        }
        get(filed) {
            if (this.errors[filed]) {
                return this.errors[filed][0]
            }
        }
        record(errors) {
            this.errors = errors
        }
        clear(){
            this.errors = {};
        }
    }
    export default {
        data() {
            return {
                author: '',
                content: '',
                created_at: '',
                commentable_id: '',
                commentable_type: '',
                comments: [],
                errors: new Errors()
            };
        },
        props: ['id', 'type'],
        created: function () {
            this.commentable_id = this.id;
            this.commentable_type = this.type;
            axios.get('/comments/' + this.type + '/' + this.id)
                .then((response) => {
                    this.comments = response.data;
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        methods: {
            addComment() {
                let newComment = {
                    author: this.author,
                    message: this.content,
                    commentable_id: this.commentable_id,
                    commentable_type: this.commentable_type
                };
                axios.post('/comments/' + this.type + '/' + this.id, newComment)
                    .then((response) => {
                        this.comments.push(response.data);
                        this.content = '';
                        this.errors.clear();
                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    });
            }
        }
    }
</script>


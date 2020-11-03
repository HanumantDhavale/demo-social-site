@extends('layouts.main')
@section('title')
    <title>My Posts</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-md-3">
            @include('component.profile-menu')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Posts</h5>
                    <hr>
                    <div class="row"
                         id="my-posts">
                        @include('component.posts')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script !src="">
        const manage_posts = new Vue({
            name: 'Manage posts',
            el: '#my-posts',
            data: {
                posts: [],
                load_posts: false,
                start_post: 0,
                limit: 5,
                total: 0
            },
            mounted: async function () {
                await this.loadPosts();
            },
            methods: {
                loadPosts: async function () {
                    this.load_posts = true;
                    nProgress.start();
                    try {
                        const response = await axios.post(`{{route('post.list')}}?user={{auth()->user()->id}}&limit=${this.limit}&start_post=${this.start_post}`);
                        this.start_post = this.start_post + this.limit;
                        this.total = response.data.total;
                        this.posts = [
                            ...this.posts,
                            ...response.data.posts
                        ];
                        nProgress.done();
                        this.load_posts = false;
                    } catch (e) {
                        console.log(e);
                        nProgress.done();
                        this.load_posts = false;
                    }
                },
                doLike: async function (post) {
                    nProgress.start();
                    try {
                        const response = await axios.post(`{{route('post.like')}}`, {
                            post_id: post.id
                        });
                        this.posts.map((post, i) => {
                            if (post.id === response.data.id) {
                                this.posts[i].likes_count = response.data.likes_count;
                                this.posts[i].like_by_me = response.data.like_by_me;
                            }
                        });
                        nProgress.done();
                    } catch (e) {
                        if (e.response.status === 419) {
                            toastr['error']('For like any post you need to login!');
                        }
                        nProgress.done();
                    }
                },
                async addComment(post) {
                    const comment = this.$refs[`comment-${post.id}`][0].value.trim();
                    if (!comment) {
                        toastr['error']('You need to add some text!');
                        return 0;
                    }
                    nProgress.start();
                    try {
                        const response = await axios.post(`{{route('post.comment')}}`, {
                            post_id: post.id,
                            comment: comment
                        });
                        this.$refs[`comment-${post.id}`][0].value = '';
                        this.posts.map((post, i) => {
                            if (post.id === response.data.comment.post_id) {
                                this.posts[i].comments_count = response.data.comments_count;
                                this.posts[i].comments.push(response.data.comment);
                            }
                        });
                        nProgress.done();
                    } catch (e) {
                        if (e.response.status === 419) {
                            toastr['error']('For comment on any post you need to login!');
                        }
                        nProgress.done();
                    }
                },
                async viewAllComments(post) {
                    nProgress.start();
                    try {
                        const response = await axios.post(`{{route('all.comments')}}`, {
                            post_id: post.id
                        });
                        this.$refs[`comment-${post.id}`][0].value = '';
                        this.posts.map((post, i) => {
                            if (post.id === response.data.post_id) {
                                this.posts[i].comments = response.data.comments;
                            }
                        });
                        nProgress.done();
                    } catch (e) {
                        if (e.response.status === 419) {
                            toastr['error']('For comment on any post you need to login!');
                        }
                        nProgress.done();
                    }
                }
            }
        });
    </script>
@endsection

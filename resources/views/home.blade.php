@extends('layouts.main')
@section('title')
    <title>Home</title>
@endsection
@section('css')
    <style>
        .input-title {
            width: 100%;
            border: none;
            background: #eee;
            padding: 10px 15px;
        }

        .input-desc {
            width: 100%;
            background: #eee;
            border: none;
            padding: 10px 15px;
        }

        .post-image-close {
            position: absolute;
            top: -12px;
            right: -10px;
            color: #f00;
            background: #00BCD4;
            width: 15px;
            height: 15px;
            line-height: 15px;
            text-align: center;
            border-radius: 50%;
        }

        .post-image-close:hover {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card"
                 id="create-post">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <input type="text"
                                   v-model="form.title"
                                   placeholder="Post title..."
                                   class="input-title">
                            <textarea
                                v-model="form.description"
                                rows="5"
                                placeholder="Post description..."
                                class="input-desc"></textarea>
                        </div>
                        <div class="col-md-5">
                            <div class="post-images-preview">
                                <div style="position:relative;width: 75px; height: 75px;float: left;padding: 10px;margin: 0 10px 10px 0;background: #eee;border: 1px solid #ddd;"
                                     v-if="form.images.length > 0"
                                     v-for="(image, i) in form.images">
                                    <img :src="image"
                                         style="width: 100%; height: auto;max-height: 100%;"
                                         alt="Post image">
                                    <span @click="removePostImages(i)"
                                          class="post-image-close">&times;</span>
                                </div>
                            </div>
                            <input type="file"
                                   @change="uploadPostImages">
                        </div>
                        <div class="col-md-2 text-right">
                            <button v-if="!form_busy"
                                    type="button"
                                    @click="createPost"
                                    class="btn btn-sm btn-success">
                                Post
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4"
         id="manage-posts">
        <div class="col-md-12">
            <div v-if="posts.length > 0"
                 v-for="post of posts"
                 :key="post.id"
                 class="card mt-4">
                <div class="card-body">
                    <a href="#">@{{post.owner.first_name}} @{{post.owner.last_name}}</a>
                    <br>
                    @{{ post.created_at }}
                    <h4 v-if="post.title">@{{ post.title }}</h4>
                    <div class="row"
                         v-if="post.images.length > 0">
                        <div v-for="image of post.images"
                             class="col-md">
                            <img class="img-fluid"
                                 :src="image.file"
                                 :alt="post.title">
                        </div>
                    </div>
                    <p v-if="post.description">@{{ post.description }}</p>
                    <hr>
                    <a href="JavaScript:void(0)"
                       @click="doLike(post)">
                        <span :class="{'fa fa-heart text-danger':post.like_by_me, 'fa fa-heart-o':!post.like_by_me}"></span>
                    </a> @{{ post.likes_count }}
                    <span class="fa fa-comment-o ml-2"></span> 10
                </div>
            </div>
            <div v-else
                 class="card mt-4">
                <div class="card-body">
                    <h4>No posts available...</h4>
                </div>
            </div>
            <div class="text-center p-4"
                 v-if="load_posts">
                Loading posts... <span class="fa fa-spin fa-circle-o-notch "></span>
            </div>
            <div class="p-3 text-center"
                 v-if="!load_posts && start_post < total">
                <button type="button"
                        class="btn btn-primary btn-sm"
                        @click="loadPosts">Load older posts
                </button>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script !src="">
        const create_post = new Vue({
            name: 'Create post',
            el: '#create-post',
            data: {
                form: {
                    title: null,
                    description: null,
                    images: []
                },
                form_busy: false
            },
            methods: {
                uploadPostImages: function (e) {
                    let file = e.target.files[0];
                    let extension = file.name.substring(file.name.lastIndexOf('.') + 1).toLowerCase();
                    if (extension == "png" || extension == "bmp" || extension == "jpeg" || extension == "jpg") {
                        let reader = new FileReader();
                        reader.onloadend = (file) => {
                            this.form.images.push(reader.result);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        $(e.target).val(null);
                        toastr['error']('Invalid file format, only image file allow.');
                    }
                },
                removePostImages: function (image) {
                    this.form.images.splice(image, 1);
                },
                createPost: async function () {
                    if (!this.form.title && !this.form.description && this.form.images.length < 1) {
                        toastr['error']('At least title or description or image required');
                        return 0;
                    }
                    this.form_busy = true;
                    nProgress.start();
                    try {
                        const response = await axios.post('{{route('post.create')}}', this.form);
                        this.form = {
                            title: null,
                            description: null,
                            images: []
                        };
                        manage_posts.posts = [
                            response.data.created_post,
                            ...manage_posts.posts
                        ];
                        toastr['success'](response.data.message);
                        nProgress.done();
                        this.form_busy = false;
                    } catch (e) {
                        console.log(e);
                        if (e.response.status === 419) {
                            toastr['error'](e.response.data.message);
                        }
                        if (e.response.status === 400) {
                            toastr['error'](e.response.data.message);
                        }
                        nProgress.done();
                        this.form_busy = false;
                    }
                    ;
                }
            }
        });
        const manage_posts = new Vue({
            name: 'Manage posts',
            el: '#manage-posts',
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
                        const response = await axios.post(`{{route('post.list')}}?limit=${this.limit}&start_post=${this.start_post}`);
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
                        //response.data
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
                }
            }
        });
    </script>
@endsection

<div class="col-md-12">
    <div v-if="posts.length > 0"
         v-for="post of posts"
         :key="post.id"
         class="card mt-4">
        <div class="card-body">
            <a :href="post.profile_url">@{{post.owner.first_name}} @{{post.owner.last_name}}</a>
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
            <span class="fa fa-comment-o ml-2"></span> @{{ post.comments_count }}
            <div class="comments">
                <div v-if="post.comments"
                     v-for="comment of post.comments"
                     class="card bg-success text-white mt-2">
                    <div class="card-header">@{{comment.commentor.first_name}} @{{comment.commentor.last_name}}</div>
                    <div class="card-body">
                        @{{ comment.comment }}
                    </div>
                </div>
                <a style="padding: 5px 0;display: inline-block;"
                   v-if="post.comments_count > post.comments.length"
                   @click="viewAllComments(post)"
                   href="JavaScript:void(0)">View all comments</a>
                <textarea rows="2"
                          class="mt-2"
                          :ref="`comment-${post.id}`"
                          style="width: 100%;border: 1px solid #ddd;padding: 15px;font-size: 14px;"
                          placeholder="Add your comment here"></textarea>
                <button type="button"
                        @click="addComment(post)"
                        class="btn btn-sm btn-primary">Comment
                </button>
            </div>
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

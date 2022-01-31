<template>
	<div>
		<div class="loading" v-if="isLoading">
			<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> 
		</div>
		<div v-if="posts != null">
			<div class="container" v-if="!isLoading && posts.data.length > 0">
				<div class="filters">
					<input checked v-model="filters" type="checkbox" name="tag_filter" value="laravel" id="laravel">
					<label for="laravel">Laravel</label>
					<input v-model="filters" type="checkbox" name="tag_filter" value="vue" id="vue">
					<label for="vue">Vue</label>
					<input v-model="filters" type="checkbox" name="tag_filter" value="php" id="php">
					<label for="php">PHP</label>
					<input v-model="filters" type="checkbox" name="tag_filter" value="api" id="api">
					<label for="api">API</label>
				</div>
				<Post
					v-for="post in posts.data"
					v-bind:key="post.title"
					v-bind:post="post"
					v-bind:filters="filters"
				/>
			</div>
			<div class="container" v-if="posts.data.length == 0">
				There are no pinboard posts! (Please see README and run command)
			</div>
		</div>
	</div>
</template>

<script>
	import Post from "./Post.vue";

    export default {
		name: 'PinboardPosts',
		data() {
			return {
				posts: null,
				filters: ['laravel'],
				isLoading: true,
			}

		},
		components: {
			Post
		},
		computed: {
			
		},
		methods: {
			fetchPosts() {
				const apiClient = axios.create({
					baseURL: `/`,
					withCredentials: false, 
					headers: {
						Accept: 'application/json',
						'Content-Type': 'application/json',
					},
					timeout: 100000
				});
				apiClient.get('/api/v1/posts')
					.then(response => {
						let results = response.data;
						console.log(response);
						this.isLoading = false;
						this.posts = results;
					})
					.catch(error => {
						this.isLoading = false;
						throw error;
					})
			},
		},
		created() {
			this.fetchPosts();
		},
	};
</script>

<style>
	.container {
		width: 95%;
		max-width: 1000px;
		margin: 0 auto;
	}
</style>
<template>
    <a :href="post.url" class="post" target="_blank" v-if="containsFilters(tagsArray, filters)">
		<div class="title">{{ post.title }}</div>
		<div class="description">{{ post.description }}</div>
		<div class="tags">
			<span>Tags:</span>
			{{ tagsArray.join(", ") }}
		</div>
    </a>
</template>

<script>
    export default {
		name: 'PinboardPosts',
		props: ['post', 'filters'],
		methods: {
			// Determine if array contains all values from another array
			containsFilters(array, filters) {
				return filters.every(value => array.includes(value));
			}
		},
		computed: {
			// Returned a parsed version of the Post Tags as array
			tagsArray() {
				return JSON.parse(this.post.tags);
			}
		},
		created() {
		},
	};
</script>

<style scoped>
	.post {
		display: inline-block;
		vertical-align: top;
		width: 275px;
		min-height: 250px;
		margin: 5px;
		padding: 5px;
		border: 1px solid grey;
		border-radius: 5px;
		position: relative;
		background-color: white;
		transition: cubic-bezier(0.075, 0.82, 0.165, 1);
		transition-duration: 200ms;
	}
	.post:hover {
		transform: scale(1.05);
	}
	.post .title {
		font-weight: bold;
	}
	.post .description {
		margin-bottom: 20px;
	}
	.post .tags {
		position: absolute;
		bottom: 0;
		margin-top: 10px;
		font-style: italic;
	}
</style>
import { baseService } from './base.service'

export function postService() {
  const base_url = 'posts'
  const axios = baseService()

  async function getPosts() {
    return axios.get(base_url)
  }

  async function getPost(id) {
    return axios.get(`${base_url}/${id}`)
  }

  async function createPost(post) {
    return axios.post(base_url, post, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  }

  async function updatePost(id, post) {
    return axios.put(`${base_url}/${id}`, post)
  }

  async function newComment(comment, post_id, user_id)
  {
    return axios.post(`${base_url}/${post_id}/comments`, {comment: comment, user: user_id})
  }

  async function deletePost(id) {
    return axios.delete(`${base_url}/${id}`)
  }

  return {
    getPosts,
    getPost,
    newComment,
    createPost,
    updatePost,
    deletePost
  }
}

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
    return axios.post(`comments`, {content: comment, post_id: post_id ,user_id: user_id})
  }

  async function deleteComment(id)
  {
    return axios.delete(`comments/${id}`)
  }

  async function deletePost(id) {
    return axios.delete(`${base_url}/${id}`)
  }

  return {
    getPosts,
    deleteComment,
    getPost,
    newComment,
    createPost,
    updatePost,
    deletePost
  }
}

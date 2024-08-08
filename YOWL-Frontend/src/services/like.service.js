import { baseService } from './base.service'

export function likeService() {
  const serve = baseService()

  async function likePost(postId, userId) {
    return await serve.post(`likes`, { post_id: postId, user_id: userId })
  }

  async function getLikes(postId) {
    return await serve.get(`likes/${postId}`)
  }

  return {
    likePost,
    getLikes
  }
}

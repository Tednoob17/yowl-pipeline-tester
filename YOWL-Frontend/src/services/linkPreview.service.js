import { baseService } from "./base.service"

export function linkPreviewService() {
    const serve = baseService()
  async function getLinkPreview(url) {
    return serve.get("https://api.linkpreview.net/?q=" + url + "&key=5c4b4b4b5b4b4b4b5b4b4b4b4b")
  }

  return {
    getLinkPreview
  }
}
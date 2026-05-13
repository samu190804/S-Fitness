export function getCookie(name: string): string {
  return decodeURIComponent(
    document.cookie
      .split('; ')
      .find(r => r.startsWith(name + '='))
      ?.split('=')[1] || ''
  )
}

export async function initCsrf(): Promise<void> {
  await fetch(`/api/sanctum/csrf-cookie`, {
    credentials: 'include'
  })
}
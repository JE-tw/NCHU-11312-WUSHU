import Swal from 'sweetalert2'

export async function useConfirmDialog({ title = '確定要刪除嗎？', text = '', confirmButtonText = '確定', cancelButtonText = '取消' } = {}) {
  const result = await Swal.fire({
    title,
    text,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText,
    cancelButtonText,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
  })

  return result.isConfirmed
}

import { ref, computed, watchEffect } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

/**
 * 表格控制器 Composable，用來處理資料列表的搜尋、分頁與排序、每頁顯示數量
 * @param {string} resourceName - 傳入頁面 props 中的資料名稱（如 "contacts"）
 * @param {string} routeName - 對應的後端 route 名稱，用於組合查詢參數送出請求
 */

export function useTableController(resourceName, routeName) {
  const page = usePage(); // Inertia 頁面物件
  // console.log('useTable props :',page.props);
  const resource = computed(() => page.props[resourceName]); // 從 props 中取得指定名稱的資料集
  
  const items = computed(() => resource.value.data ?? []); // 解析資料內容（每頁的資料陣列）
  const currentPage = computed(() => resource.value.current_page); // 目前頁碼
  const totalPages = computed(() => resource.value.last_page); // 總頁數

  const searchQuery = ref(''); // 搜尋字串
  // 當前排序欄位與方向
  const currentSortKey = ref('id');
  const currentSortDirection = ref('asc');

  /**
   * 處理搜尋事件
   * @param {string} keyword - 使用者輸入的搜尋關鍵字
   */
  const handleSearch = (keyword) => {
    searchQuery.value = keyword;
    router.get(
      route(routeName),
      {
        search: keyword,
        sort: currentSortKey.value,
        direction: currentSortDirection.value,
        page: 1, // 搜尋後回到第一頁
      },
      {
        preserveState: true, // 保留頁面狀態
        preserveScroll: true, // 保留卷軸位置
      },
    );
  };

  /**
   * 處理分頁變更
   * @param {number} pageNum - 切換的目標頁碼
   */

  const handlePageChange = (pageNum) => {
    router.get(
      route(routeName),
      {
        page: pageNum,
        search: searchQuery.value,
        sort: currentSortKey.value,
        direction: currentSortDirection.value,
      },
      {
        preserveState: true,
        preserveScroll: true,
      },
    );
  };

  /**
   * 處理排序變更
   * @param {{ sortKey: string, sortDirection: string }} payload - 包含新的排序欄位與方向
   */

  const handleSortChange = ({ sortKey, sortDirection }) => {
    currentSortKey.value = sortKey;
    currentSortDirection.value = sortDirection;
    router.get(
      route(routeName),
      {
        search: searchQuery.value,
        page: 1, // 排序後回到第一頁
        sort: sortKey,
        direction: sortDirection,
      },
      {
        preserveState: true,
        preserveScroll: true,
      },
    );
  };

  // 回傳供元件使用的狀態與操作方法
  return {
    items,
    currentPage,
    totalPages,
    searchQuery,
    currentSortKey,
    currentSortDirection,
    handleSearch,
    handlePageChange,
    handleSortChange,
  };
}

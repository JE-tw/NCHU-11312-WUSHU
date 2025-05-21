# 練習專案（五術研究社）

本專案為團隊合作練習作品，使用 Laravel + Vue 進行全端開發。  
本 fork 版本由本人整理並標註所負責功能，作為作品集參考。

## 🔧 我的貢獻

本專案由多人協作完成，我主要負責以下功能與開發：

- 後台管理系統功能開發（會員管理、服務紀錄、訂單資料）
- Laravel 資料表建置（含 migration、seeder）
- 前後端會員登入/註冊系統整合（含驗證機制）
- 串接 MySQL 資料庫與測試假資料流程設計

---

## 📦 專案建置流程說明

### ✅ 環境需求
- PHP（建議搭配 XAMPP）
- Composer
- Node.js & npm
- MySQL 資料庫


## 初次 clone 專案後建置流程

1. 安裝前端依賴
    ```bash
    npm install
    ```

2. 安裝後端 PHP 依賴
    ```bash
    composer install
    ```

3. 複製 `.env` 環境設定檔
    ```bash
    cp .env.example .env
    ```

4. 修改 `.env` 設定
    - 打開 `.env`，找到 `DB_CONNECTION=mysql` 以下區塊，取消註解（拿掉行首的 `#`）

5. 生成專案金鑰
    ```bash
    php artisan key:generate
    ```

6. 重新遷移資料庫並填入假資料
    ```bash
    php artisan migrate:fresh --seed
    ```
    第一次建置專案用

    ```bash
    php artisan migrate --seed
    ```

7. 編譯前端資源（開發模式）
    ```bash
    composer run dev
    ```

---

## 常見問題

### 問題：執行 `php artisan migrate --seed` 出現 "intl" 相關錯誤

**解法：**

- 打開 XAMPP 的 `php.ini` 設定檔
- 搜尋 `;extension=intl`
- 把前面的分號 `;` 刪除
- 儲存檔案並重新啟動 Apache

（這個設定只需要在每台新電腦上做一次）

📂 資料來源與授權
原始專案由中興大學南投數據班課程提供架構與需求，本人僅作為練習與展示用途使用。
如有侵權或需下架請與我聯絡，將立即處理，感謝 🙏
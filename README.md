# 專案建置流程說明

## 環境需求
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
    php artisan migrate --seed

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


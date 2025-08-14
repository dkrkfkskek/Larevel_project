## 🛠 기술 스택

- **백엔드**: Laravel 12.24.0 , PHP 8.3.23
- **데이터베이스**: MySQL

---

## ⚙️ 시작하기

이 프로젝트를 로컬 환경에서 실행하기 위한 단계별 가이드입니다.

### 전제 조건

* PHP
* Composer
* MySQL

### 설치

1.  **레포지토리 복제**
    ```bash
    git clone https://github.com/dkrkfkskek/Larevel_project.git
    cd Larevel_project
    ```

2.  **의존성 설치**
    ```bash
    composer install
    ```

### 설정

1.  **.env 파일 생성 및 설정**
    `.env.example` 파일을 복사하여 `.env` 파일을 만듭니다.
    ```bash
    cp .env.example .env
    ```
    `.env` 파일의 `DB_` 설정과 `APP_KEY`를 자신의 환경에 맞게 수정합니다.


2.  **테이블 생성**
    ```bash
    php artisan migrate --path=/database/migrations/2025_08_14_030054_create_posts_table.php
    php artisan migrate --path=/database/migrations/2025_08_14_030054_create_comments_table.php
    ```

2.  **더미 데이터 생성**
    ```bash
    php artisan migrate --seed
    ```
### 실행

```bash
php artisan serve
```

### 그 외

1. Postman collection 참고하여 테스트 진행


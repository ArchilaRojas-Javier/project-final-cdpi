# Vitam-in

## MCD

```mermaid
erDiagram
    User {
        int id PK
        string email
        string password_hash
        string full_name
        enum sex
        json role
        string avatar_path
        string oauth_provider
        string oauth_id
        datetime created_at
    }

    SupplementType {
        int id PK
        string name
    }

    Supplement {
        int id PK
        string name
        string description
        json dosage_schedule
        int on_duration_days
        int off_duration_days
        string precautions
        int supplement_type_id FK
    }

    Benefit {
        int id PK
        string name
    }

    UserSupplement {
        int id PK
        datetime start_date
        int duration_days
        json dosage_schedule      
        string precautions
    }

    Reminder {
        int id PK
        string google_event_id
        bool is_active
        datetime created_at
    }

    Note {
        int id PK
        text content
        datetime created_at
    }

    Comment {
        int id PK
        text content
        bool is_approved
        datetime created_at
    }

    Response {
        int id PK
        text content
        datetime created_at
    }

    Like {
        int id PK
        datetime created_at
    }

    Report {
        int id PK
        string reason
        datetime created_at
    }

    PasswordReset {
        int id PK
        string token_hash
        datetime expires_at
    }

    User ||--o{ UserSupplement : "has"
    User ||--o{ Comment : "writes"
    User ||--o{ Response : "writes"
    User ||--o{ Like : "gives"
    User ||--o{ Report : "creates"
    User ||--o{ PasswordReset : "has"

    Supplement ||--o{ UserSupplement : "has"
    Supplement }o--o{ Benefit : "associated"
    Supplement ||--o{ Comment : "has"
    Supplement }o--|| SupplementType : "belongs"

    UserSupplement ||--o{ Note : "has"
    UserSupplement ||--o{ Reminder : "has"

    Comment ||--o{ Response : "has"
    Comment |o--o{ Like : "has"
    Comment |o--o{ Report : "has"

    Response |o--o{ Like : "has"
    Response |o--o{ Report : "has"
```

    users ||--o{ user_supplement : "suit"
    users ||--o{ comments : "écrit"
    users ||--o{ password_resets : "demande"
    users ||--o{ comment_likes : "like"
    users ||--o{ comment_reports : "signale"
    supplements ||--o{ user_supplement : "suivi dans"
    supplements ||--o{ comments : "reçoit"
    supplements ||--o{ supplement_category : "classé dans"
    categories ||--o{ supplement_category : "contient"
    supplements ||--o{ supplement_benefit : "associé à"
    benefits ||--o{ supplement_benefit : "bénéfice de"
    comments ||--o{ comments : "réponse à"
    comments ||--o{ comment_likes : "reçoit"
    comments ||--o{ comment_reports : "signalé"
    user_supplement ||--o{ notes : "contient"

    users {
        int id PK
        varchar email UK
        varchar password_hash
        varchar role
        varchar name
        int age
        varchar avatar
        varchar google_id UK
        text google_access_token
        text google_refresh_token
        boolean google_calendar_linked
        timestamp created_at
    }

    password_resets {
        int id PK
        int user_id FK
        varchar token_hash
        timestamp expires_at
        boolean used
    }

    supplements {
        int id PK
        varchar name UK
        text description
        text benefits
        varchar recommended_dosage
        int recommended_duration
        varchar recommended_moment
        text precautions
    }

    categories {
        int id PK
        varchar name UK
    }

    supplement_category {
        int supplement_id PK,FK
        int category_id PK,FK
    }

    benefits {
        int id PK
        varchar name UK
    }

    supplement_benefit {
        int supplement_id PK,FK
        int benefit_id PK,FK
    }

    user_supplement {
        int id PK
        int user_id FK
        int supplement_id FK
        date start_date
        date end_date
        varchar custom_dosage
        time custom_hour
        varchar custom_instruction
        varchar google_event_id
        boolean is_active
    }

    notes {
        int id PK
        int user_supplement_id FK
        text content
        timestamp created_at
    }

    comments {
        int id PK
        int user_id FK
        int supplement_id FK
        text content
        timestamp created_at
        int parent_comment_id FK
        boolean is_approved
    }

    comment_likes {
        int user_id PK,FK
        int comment_id PK,FK
    }

    comment_reports {
        int id PK
        int reporter_id FK
        int comment_id FK
        text reason
        timestamp created_at
        boolean is_resolved
    }
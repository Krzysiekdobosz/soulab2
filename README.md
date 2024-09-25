
Krzysztof Dobosz 22.09.2024

## Technologie i biblioteki

### Frontend
- **Vue.js 3**
- **Tailwind CSS**
- **Vite**
- **Vuelidate**

### Backend
- **Symfony 6**
- **Doctrine ORM**
- **NelmioCorsBundle**

## Struktura projektu

- **backend/**: Katalog z aplikacją Symfony
- **frontend/**: Katalog z aplikacją Vue.js

## Instalacja i uruchomienie projektu

1. **Klonowanie repozytorium i przejście do katalogu `backend`:**

   ```bash
   git clone https://github.com/Krzysiekdobosz/soulab.git
   cd soulab/backend
   ```

2. **Zainstaluj zależności przy użyciu Composer:**

   ```bash
   composer install
   ```

3. **Konfiguracja bazy danych**

   Aplikacja korzysta z bazy danych MySQL. Aby skonfigurować bazę danych:

   - Upewnij się, że masz zainstalowany i uruchomiony serwer MySQL.
   - Utwórz bazę danych o nazwie `soulab`:

     ```bash
     mysql -u root -p
     ```

     Następnie w konsoli MySQL:

     ```sql
     CREATE DATABASE soulab CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     ```

4. **Skonfiguruj połączenie z bazą danych**

   Edytuj plik `.env` i ustaw zmienną `DATABASE_URL`:

   ```dotenv
   DATABASE_URL="mysql://DB_USER:DB_PASSWORD@127.0.0.1:3306/soulab?serverVersion=YOUR_MYSQL_VERSION&charset=utf8mb4"
   ```

   - `DB_USER`: nazwa użytkownika bazy danych (np. root).
   - `DB_PASSWORD`: hasło do bazy danych.
   - `YOUR_MYSQL_VERSION`: wersja Twojego serwera MySQL (np. 8.0).

5. **Migracja bazy danych**

   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

6. **Uruchom serwer Symfony:**

   ```bash
   symfony server:start
   ```

   Backend będzie dostępny pod adresem http://localhost:8000.

## Frontend

Przejdź do katalogu frontend:

```bash
cd ../frontend
```

Zainstaluj zależności przy użyciu npm:

```bash
npm install
```

Uruchom aplikację frontendową w trybie deweloperskim:

```bash
npm run dev
```

Frontend będzie dostępny pod adresem http://localhost:5173.

Po wykonaniu powyższych kroków powinieneś być w stanie uruchomić aplikację lokalnie i korzystać z pełnej funkcjonalności.

## Zdjęcia poglądowe aplikacji
![image](https://github.com/user-attachments/assets/d6d6342d-6eef-46cf-8eed-ebd02cc18ca1)

# 🚀 Dashy Setup (Self-Hosted Dashboard)

Dashy is a beautiful, customizable dashboard to manage all your NAS services in one place.

---

## 🛠️ Docker Setup

### 1. `.env` File

```env
DASHY_PORT=4000
DASHY_CONFIG=./config.yml
DASHY_IMAGE=lissy93/dashy
```

### 2. `docker-compose.yml`

```yaml
version: '3.8'

services:
  dashy:
    image: ${DASHY_IMAGE}
    container_name: dashy
    ports:
      - "${DASHY_PORT}:8080"
    volumes:
      - ${DASHY_CONFIG}:/app/public/conf.yml
    restart: unless-stopped
```

### 3. Run the Container

```bash
docker compose up -d
```

---

## 🌐 Access Dashy

- Local URL: [http://localhost:4000](http://localhost:4000)
- LAN URL: [http://192.168.1.101:4000](http://192.168.1.101:4000)

---

## ⚙️ Configuration

Edit the `config.yml` file (mounted inside the container) to customize:

- Tiles & Categories
- Icons & Themes
- Widgets (Weather, Clock, etc.)

Official Docs: [https://dashy.to/docs](https://dashy.to/docs)

---

## 🧠 Notes

- Internal Dashy port is always `8080`. Traefik or Docker must route to this.
- Example port mapping: `4000:8080`
- Avoid setting `4000:4000` — Dashy runs on `8080` inside container.
- Confirm container is running:

  ```bash
  docker ps | grep dashy
  ```

---

## ✅ Status

- [x] Dashy running on Docker
- [x] Accessible at LAN IP
- [x] Custom config mounted
- [ ] Traefik reverse proxy (Next step)


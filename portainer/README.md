# 🐳 README_PORTAINER.md — Docker Commander Setup

## 👑 Persona: King Pony's Docker Army

This document captures the setup of **Portainer**, the visual commander of your self-hosted empire.

---

## 📁 Folder Structure

```bash
docker/
└── portainer/
    ├── docker-compose.yml
    └── README_PORTAINER.md ← You are here
```

---

## ⚙️ Docker Compose File

```yaml
version: "3.3"

services:
  portainer:
    image: portainer/portainer-ce:latest
    container_name: portainer
    restart: unless-stopped
    ports:
      - "9000:9000"
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - portainer_data:/data
    networks:
      - traefik-net
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.portainer.rule=Host(`portainer.vnasmanu.sbs`)"
      - "traefik.http.routers.portainer.entrypoints=web"
      - "traefik.http.services.portainer.loadbalancer.server.port=9000"

volumes:
  portainer_data:

networks:
  traefik-net:
    external: true
```

> 🧠 The `traefik-net` network connects Portainer to Traefik for reverse proxying.

---

## 🌐 Public Access via Cloudflare Tunnel

**Subdomain:** `portainer.vnasmanu.sbs`  
**Service:** `http://traefik:80`  
**TLS Verify:** ❌ Disabled (Traefik handles TLS termination)

---

## 🚀 Access URLs

| Type     | URL                                 |
|----------|--------------------------------------|
| Local    | `http://192.168.1.101:9000`          |
| Public   | `https://portainer.vnasmanu.sbs`     |

---

## 🔑 First-Time Login

1. Go to `https://portainer.vnasmanu.sbs`
2. Set up admin username and password
3. Portainer auto-connects to the local Docker environment
4. Ready to visually manage all services

---

## 🧱 Troubleshooting

| Problem                           | Solution                                                                 |
|----------------------------------|--------------------------------------------------------------------------|
| ❌ Site won't load               | Ensure Cloudflare subdomain for `portainer.vnasmanu.sbs` exists         |
| ❌ Traefik shows 404             | Check labels + network is `traefik-net`                                 |
| ❌ Portainer not reachable       | Restart container & check port `9000`                                   |
| ❌ Tunnel error (SSL/timeout)   | Restart `cloudflared`, verify domain config                             |

---

## ✅ Status

- [x] Portainer Docker container running
- [x] Subdomain `portainer.vnasmanu.sbs` active via Cloudflare Tunnel
- [x] Traefik reverse proxy working
- [x] Portainer accessible from local and global network

---

## 🧭 Next Steps

- 🔐 Add basic auth or Authentik middleware (optional)
- 🛠 Use Portainer to monitor and deploy future containers
- 📜 Continue logging services with their own README scrolls

---

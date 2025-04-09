# 📦 Nextcloud – Private Cloud Storage

This directory contains the Dockerized setup for running **Nextcloud**, a self-hosted productivity platform (like your personal Google Drive) behind a secure reverse proxy using **Traefik** and **Cloudflare Tunnel**.

🔗 Access: [https://nextcloud.vnasmanu.sbs](https://nextcloud.vnasmanu.sbs)

---

## 🧱 Services

| Service       | Description                        |
|---------------|------------------------------------|
| `nextcloud`   | Web interface + application logic  |
| `nextcloud_db`| MariaDB database backend           |

---

## ⚙️ Features

- ✅ HTTPS via Let's Encrypt (DNS challenge using Cloudflare)
- ✅ Reverse proxy with Traefik
- ✅ Cloudflare Tunnel enabled (no port forwarding)
- ✅ Docker volume persistence
- ✅ Optional local debug access via port `9100`
- ✅ Compatible with `.local` DNS rewrites using AdGuard

---

## 🐳 Docker Compose Overview

```yaml
services:
  nextcloud:
    image: nextcloud:28
    ...
    labels:
      - traefik.enable=true
      - traefik.http.routers.nextcloud.rule=Host(`nextcloud.vnasmanu.sbs`)
      - traefik.http.routers.nextcloud.entrypoints=websecure
      - traefik.http.routers.nextcloud.tls=true
      - traefik.http.routers.nextcloud.tls.certresolver=cloudflare
      - traefik.docker.network=traefik-net
      - traefik.http.services.nextcloud.loadbalancer.server.port=80

  db:
    image: mariadb:10.11
    ...

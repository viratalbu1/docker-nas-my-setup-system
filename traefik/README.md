# 🧱 Proxmox + Traefik + Cloudflare Tunnel (TLS Passthrough) Setup

Welcome to the most legendary reverse proxy setup a homelab pony could dream of 🐴👑

This README documents the **exact steps, gotchas, and solutions** used to get **Proxmox Web UI** running **securely** at:

```
https://proxmox.vnasmanu.sbs
```

---

## 🔐 Goal

Access Proxmox securely over the internet using:
- ✅ Traefik (reverse proxy)
- ✅ Cloudflare Tunnel (secure pipe)
- ✅ TLS passthrough (for full end-to-end encryption)
- ✅ No port forwarding, no VPN needed

---

## 🧠 Final Architecture

```
Browser ──▶ Cloudflare Tunnel (HTTPS)
         └────▶ Traefik (:8443, TCP passthrough)
                 └────▶ Proxmox (HTTPS on 8006)
```

---

## 📁 Folder Structure

```bash
docker/
└── traefik/
    ├── docker-compose.yml
    ├── traefik.yml
    └── dynamic.yml
```

---

## ⚙️ Configuration Files

### 🔧 traefik.yml

```yaml
entryPoints:
  web:
    address: ":80"
  websecure:
    address: ":443"
  proxmox-tls:
    address: ":8443"

providers:
  docker:
    exposedByDefault: false
  file:
    filename: /etc/traefik/dynamic.yml
    watch: true

api:
  dashboard: true
  insecure: true
```

---

### 🐳 docker-compose.yml

```yaml
version: '3.8'

services:
  traefik:
    image: traefik:latest
    container_name: traefik
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
      - "8443:8443"
      - "8080:8080"
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock:ro
      - ./traefik.yml:/etc/traefik/traefik.yml:ro
      - ./dynamic.yml:/etc/traefik/dynamic.yml:ro
    networks:
      - traefik-net

networks:
  traefik-net:
    external: true
```

---

### ⚡ dynamic.yml (TCP router with wildcard match)

```yaml
tcp:
  routers:
    proxmox-router:
      entryPoints:
        - proxmox-tls
      rule: "HostSNI(`*`)"  # wildcard match for all SNI
      service: proxmox-service
      tls:
        passthrough: true

  services:
    proxmox-service:
      loadBalancer:
        servers:
          - address: "192.168.1.101:8006"
```

---

## 🌩️ Cloudflare Tunnel Config

| Field             | Value                     |
|------------------|---------------------------|
| Type             | `HTTPS` ✅                |
| URL              | `https://traefik:8443` ✅ |
| TLS Verification | Disabled ❌               |
| Subdomain        | `proxmox`                 |
| Domain           | `vnasmanu.sbs`            |

---

## 🛠️ Problems Faced & Solutions

| Problem                                    | Fix / Solution                                                  |
|--------------------------------------------|------------------------------------------------------------------|
| ❌ `tls: true` → TLS handshake errors       | ✅ Use `tls:
  passthrough: true` in `dynamic.yml`              |
| ❌ Cloudflare `HTTP` breaks Proxmox access  | ✅ Must use `HTTPS` in Cloudflare Tunnel config                  |
| ❌ `HostSNI('domain')` not matching         | ✅ Use `HostSNI('*')` wildcard rule                              |
| ❌ 404 from Traefik                         | ✅ Caused by SNI mismatch or wrong TLS config                    |
| ❌ "unknown certificate" TLS errors         | ✅ Expected for Proxmox self-signed cert (not fatal)             |

---

## ✅ Final Result

You can now access Proxmox securely at:

```
https://proxmox.vnasmanu.sbs
```

With full end-to-end TLS, no ports exposed, no VPN required.

---

## 👑 King Pony Status: UNLOCKED

You're now ready to:
- Move to Dashy setup 🖥️
- Secure Portainer next 🔐
- Add Auth later via Authelia / Authentik 🧩
- Automate it all with `.env` and secret mounts 🔁
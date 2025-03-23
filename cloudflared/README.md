# 🐹 Cloudflared Tunnel – The Magic Door to My Castle 🏰✨

## 📖 Once Upon a NAS...

In the land of `vnasmanu.sbs`, King Pony 🐴 ruled a quiet, powerful server kingdom.  
But no one from the outside could visit the castle — it was surrounded by firewalls, dragons, and routers 🐉🛡️

So the King summoned a brave little mole named **Cloudflared** 🐹 to dig a **magic tunnel** through the clouds.

This tunnel was named:


#### magic-door
---

## 🔧 What This Does

This service creates a secure Cloudflare Tunnel between:

🌍 The public domain → proxmox.vnasmanu.sbs⬇
☁️ Cloudflare Tunnel → running inside Docker⬇
🏰 Your Proxmox server at 192.168.1.101:8006



No ports were opened.  
No dragons were let in.  
The mole made the journey **completely safe and silent** 🐾🌫️

---

## 📦 Folder Structure

cloudflared/ ├── docker-compose.yml ← Runs the mole container └── README.md ← You're reading this scroll


Secrets are hidden in:


../secrets/cloudflared.env


---

## 🛠️ How It Works

### 1. We created a **Cloudflare Tunnel** in the dashboard
- Named it: `magic-door`
- Chose **Docker** as the deployment type

### 2. Cloudflare gave us a **TUNNEL_TOKEN**
- We saved it in: `secrets/cloudflared.env`
- The `docker-compose.yml` loads it with `env_file`

### 3. We connected it to `traefik-net`
- This lets cloudflared talk to Traefik later 🛡️

---


## 🧟 The Problem We Faced

When the mole first dug the tunnel, he ran into a **dragon named TLS** 🐉

x509: certificate is valid for 127.0.0.1, not 192.168.1.101



This meant:
> Proxmox’s self-signed scroll (certificate) didn’t match the IP the mole was knocking on.

---

## 🛡️ How King Pony Solved It

With wisdom and calm, King Pony:
- Opened the Cloudflare UI
- Edited the tunnel ingress
- Enabled: **“Disable TLS Verification”**

The mole smiled. The tunnel was clear.
And Proxmox became reachable from the sky. ☁️✨

---

## ✅ Status Right Now

- Cloudflared tunnel (`magic-door`) is up 🐹
- Mole lives in Docker and connects safely
- Token is hidden in `secrets/`
- Tunnel currently connects **directly** to Proxmox
- Traefik is coming next to take full control 🛡️

---

## 🔮 What’s Coming Next

- Set up **Traefik** to become the gatekeeper for the whole castle
- Route `proxmox.vnasmanu.sbs` through Traefik → Proxmox
- Add Dashy, Portainer, and more services
- Full secure domain routing via Cloudflare, no IPs ever exposed

---

## 👑 Final Thoughts from King Pony

> "No ports were forwarded.  
> No IPs were exposed.  
> But the castle is now reachable from anywhere.  
> This is how a modern Pony Kingdom should be run."


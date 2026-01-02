# fedora-mediawiki-theme

The theme for the fedora wiki

## Quick Start with Containers (Recommended)

The easiest way to get started is using Podman.


### Prerequisites

Install [Podman](https://podman.io/docs/installation) **and** the [podman-compose](https://github.com/containers/podman-compose#installation) package. (Some systems do not install `podman-compose` automatically with Podman, so it is best to install it explicitly.)

Then enable the Podman service:

```bash
# Enable and start the Podman socket (for compose)
systemctl --user enable --now podman.socket
```

### Configuration

Create a `.env` file from the provided template:

```bash
cp .env.example .env
```

Edit `.env` to customize settings like `ADMIN_PASSWORD`, `SITENAME`, database credentials, etc. The `.env.example` file contains all available configuration options with sensible defaults.

### Start the Containers

```bash
# Using Podman (recommended)
podman compose up -d
```

Once the containers are running, open http://localhost:8080/w/ in your browser.

**Login credentials:**

```
Username: Admin
Password: AdminPassword123!
```

## Local Development with Vagrant

Set up a local MediaWiki development environment using Vagrant and libvirt. This will provision a Fedora Linux virtual machine with MediaWiki, PostgreSQL, and the Fedora theme, ready for development.

## Prerequisites

Install Vagrant, vagrant-libvirt, vagrant-sshfs, and Ansible from the Fedora Linux repositories:

```bash
sudo dnf install -y vagrant vagrant-libvirt vagrant-sshfs ansible
```

Enable and start the libvirtd service:

```bash
sudo systemctl enable --now libvirtd
systemctl status libvirtd
```

Install the Vagrant hostmanager plugin:

```bash
vagrant plugin install vagrant-hostmanager
```

## Starting the Virtual Machine

From the clone directory (where the `Vagrantfile` is located), run the following command to create your development environment:

```bash
vagrant up
```

If the virtual machine already exists and you need to reprovision:

```bash
vagrant provision
```

## First Boot

On first boot, Vagrant will:

- Download the Fedora 42 Cloud base box (~500MB)
- Create and configure the virtual machine
- Install Python dependencies via shell provisioning
- Run Ansible playbooks to:
  - Install basic system utilities ([core role](ansible/roles/core/tasks/main.yml))
  - Set up PostgreSQL database ([db role](ansible/roles/db/tasks/main.yml))
  - Install and configure MediaWiki with Fedora skin ([dev role](ansible/roles/dev/tasks/main.yml))

For more details, see the [ansible/ directory](ansible/) and [main playbook](ansible/playbook.yml).

Provisioning typically takes 5–10 minutes, depending on your internet connection.

## Accessing MediaWiki

After provisioning, access MediaWiki at:

- **http://localhost:8080/w/** (via SSH port forwarding — recommended)
- **http://192.168.122.X/w/** (via VM's IP — check with `vagrant ssh wiki -c "hostname -I"`)
- **http://wiki.tinystage.test/w/** (if DNS is configured)

**Login credentials:**

```
Username: Admin
Password: AdminPassword123!
```

## Development Workflow

The `Fedora/` directory is mounted into the VM at `/usr/share/mediawiki/skins/Fedora` using SSHFS. Any changes you make to skin files on your host are instantly reflected in the VM.

To develop:

- Edit files in the `Fedora/` directory on your host
- Refresh your browser to see CSS/JS changes
- For PHP changes, you may need to clear the MediaWiki cache

After major changes or configuration updates, reload the VM:

```bash
vagrant reload wiki
```

## Specifications

- **OS:** Fedora 42 Cloud Base
- **CPUs:** 2
- **Memory:** 2048 MB
- **Disk:** 5 GB
- **Network:** NAT (192.168.122.0/24)

## Additional Resources

- [Podman Documentation](https://docs.podman.io/en/stable/Commands.html)
- [Vagrant Documentation](https://www.vagrantup.com/docs)
- [vagrant-libvirt Provider](https://github.com/vagrant-libvirt/vagrant-libvirt)
- [vagrant-libvirt Troubleshooting](https://vagrant-libvirt.github.io/vagrant-libvirt/troubleshooting.html)
- [Ansible Documentation](https://docs.ansible.com/)
- [MediaWiki Skin Development](https://www.mediawiki.org/wiki/Manual:Developing_skins)

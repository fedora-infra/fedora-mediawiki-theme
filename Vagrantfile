# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box_url = "https://download.fedoraproject.org/pub/fedora/linux/releases/24/CloudImages/x86_64/images/Fedora-Cloud-Base-Vagrant-24-1.2.x86_64.vagrant-libvirt.box"
  config.vm.box = "f24-cloud-libvirt"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.synced_folder "Fedora", "/usr/share/mediawiki/skins/Fedora", type: "sshfs"

  # Ansible needs the guest to have these
  config.vm.provision "shell", inline: "sudo dnf install -y libselinux-python python2-dnf"

  config.vm.provision "ansible" do |ansible|
      ansible.playbook = "ansible/playbook.yml"
  end

  config.vm.post_up_message = "Provisioning Complete."

end

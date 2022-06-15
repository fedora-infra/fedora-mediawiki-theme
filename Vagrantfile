# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
 config.vm.network "forwarded_port", guest: 80, host: 8080
 config.vm.box = "fedora/36-cloud-base"
 config.vm.synced_folder "Fedora", "/usr/share/mediawiki/skins/Fedora", type: "sshfs"

 # This is a plugin that updates the host's /etc/hosts
 # file with the hostname of the guest VM. In Fedora it is packaged as
 # ``vagrant-hostmanager``
 config.hostmanager.enabled = true
 config.hostmanager.manage_host = true

 # Ansible needs the guest to have these
 config.vm.provision "shell", inline: "sudo dnf install -y python3-libselinux python3-libsemanage"

 config.vm.provision "ansible" do |ansible|
   ansible.playbook = "ansible/playbook.yml"
 end

 # Create the "wiki" box
 config.vm.define "wiki" do |pagure|
    pagure.vm.host_name = "wiki.tinystage.test"

    pagure.vm.provider :libvirt do |domain|
        # Season to taste
        domain.cpus = 2
        domain.graphics_type = "spice"
        domain.memory = 2048
        domain.video_type = "qxl"

        # Uncomment the following line if you would like to enable libvirt's unsafe cache
        # mode. It is called unsafe for a reason, as it causes the virtual host to ignore all
        # fsync() calls from the guest. Only do this if you are comfortable with the possibility of
        # your development guest becoming corrupted (in which case you should only need to do a
        # vagrant destroy and vagrant up to get a new one).
        #
        # domain.volume_cache = "unsafe"
    end
 end

 config.vm.post_up_message = "Provisioning Complete."

end

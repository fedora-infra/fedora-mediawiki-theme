# fedora-mediawikitheme

The theme for the fedora wiki

Hacking with Vagrant
====================
Quickly start hacking on the fedora wiki theme by using the vagrant setup that
is included this repo.

First, install Vagrant and the vagrant-libvirt plugin from the official Fedora
repos::

    $ sudo dnf install vagrant vagrant-libvirt

The vagrant setup uses vagrant-sshfs for syncing files between your
host and the vagrant dev machine. vagrant-sshfs is not in the Fedora repos
(yet), so we install the vagrant-sshfs plugin from dustymabe's COPR repo::

    $ sudo dnf copr enable dustymabe/vagrant-sshfs
    $ sudo dnf install vagrant-sshfs

Now, from within main directory (the one with the Vagrantfile in it) of your git
checkout of elections, run the ``vagrant up`` command to provision your dev
environment::

    $ vagrant up

When this command is completed (it may take a while), simply go to
http://localhost:8080/ in your browser on your host to see your running
mediawiki instance with the fedora theme.

# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|
    config.vm.box = "ubuntu64precise"
    config.vm.box_url = "http://files.vagrantup.com/precise64.box"

    config.vm.boot_mode = :gui

    config.vm.network :hostonly, "192.168.171.10"
    config.vm.provision :shell, :path => "provision.sh"
end

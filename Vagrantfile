Vagrant.configure("2") do |config|
  
  # Máquina Web
  config.vm.define "web" do |web|
    web.vm.box = "bento/ubuntu-22.04"
    web.vm.hostname = "web"
    web.vm.network "private_network", ip: "192.168.56.10"
    
    web.vm.provider "virtualbox" do |vb|
      vb.memory = "1024"
      vb.cpus = 1
    end
    
    web.vm.synced_folder "./web", "/var/www/html"
    web.vm.provision "shell", path: "provision-web.sh"
  end
  
  # Máquina DB (reto)
  config.vm.define "db" do |db|
    db.vm.box = "bento/ubuntu-22.04"
    db.vm.hostname = "db"
    db.vm.network "private_network", ip: "192.168.56.11"
    
    db.vm.provider "virtualbox" do |vb|
      vb.memory = "1024"
      vb.cpus = 1
    end
    
    db.vm.provision "shell", path: "provision-db.sh"
  end
end


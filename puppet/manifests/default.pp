exec { 'apt-get update' :
    command => 'apt-get update',
    path    => '/usr/bin/',
    timeout => 60,
    tries   => 3
}

class { 'apt' :
    always_apt_update => true
}

package { ['python-software-properties'] :
    ensure  => 'installed',
    require => Exec['apt-get update'],
}

package { ['build-essential', 'vim', 'curl'] :
    ensure  => 'installed',
    require => Exec['apt-get update'],
}

file { '/home/vagrant/.bash_aliases' :
    source => 'puppet:///modules/puphpet/dot/.bash_aliases',
    ensure => 'present',
}

apt::ppa { 'ppa:ondrej/php5' : }
class { 'apache' : require => Apt::Ppa['ppa:ondrej/php5'],}

apache::dotconf { 'custom' :
    content => 'EnableSendfile Off',
}

apache::module { 'rewrite' : }

apache::vhost { 'opencfp.me' :
    server_name   => 'opencfp.me',
    serveraliases => ['www.opencfp.me'],
    docroot       => '/var/www/opencfp/web',
    port          => '80',
    env_variables => [],
    priority      => '1'
}

class { 'php' :
    service => 'apache',
    require => Package['apache'],
}

php::module { 'cli' : }
php::module { 'curl' : }
php::module { 'intl' : }
php::module { 'mcrypt' : }
php::module { 'mysql' : }

class { 'php::devel' :
    require => Class['php'],
}

class { 'php::pear' :
    require => Class['php'],
}


php::pecl::module { 'pecl_http' :
    use_package => false
}
php::pecl::module { 'memcache' :
    use_package => false
}

class { 'xdebug' : }

xdebug::config { 'cgi' : }
xdebug::config { 'cli' : }

php::ini { 'default' :
    value    => [
        'date.timezone = America/Chicago',
        'display_errors = On',
        'error_reporting = -1'
    ],
    target   => 'error_reporting.ini'
}

class { 'mysql' :
    root_password => 'opencfp',
}

mysql::grant { 'opencfp' :
    mysql_privileges => 'ALL',
    mysql_db         => 'opencfp',
    mysql_user       => 'opencfp',
    mysql_password   => 'opencfp',
    mysql_host       => 'localhost',
}

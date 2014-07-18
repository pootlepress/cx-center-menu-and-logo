<?php
/**
 * Created by Alan on 15/7/2014.
 */

if (!class_exists('Pootlepress_Updater')) {
    class Pootlepress_Updater {
        /**
         * The plugin current version
         * @var string
         */
        public $current_version;

        /**
         * The plugin remote update path
         * @var string
         */
        public $update_path;

        /**
         * Plugin Slug (plugin_directory/plugin_file.php)
         * @var string
         */
        public $plugin_slug;

        /**
         * Plugin name (plugin_file)
         * @var string
         */
        public $slug;

        /**
         * Initialize a new instance of the WordPress Auto-Update class
         * @param string $current_version
         * @param string $update_path
         * @param string $plugin_slug
         */
        function __construct($current_version, $update_path, $plugin_slug)
        {
            // Set the class public variables
            $this->current_version = $current_version;
            $this->update_path = $update_path;
            $this->plugin_slug = $plugin_slug;
            list ($t1, $t2) = explode('/', $plugin_slug);
            $this->slug = $t1;

            // define the alternative API for updating checking
            add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_update'));

            // Define the alternative response for information checking
            add_filter('plugins_api', array(&$this, 'check_info'), 10, 3);
        }

        /**
         * Add our self-hosted autoupdate plugin to the filter transient
         *
         * @param $transient
         * @return object $ transient
         */
        public function check_update($transient)
        {
            // Get the remote version
            $remote_version = $this->getRemote_version();

            // If a newer version is available, add the update
            if (version_compare($this->current_version, $remote_version, '<')) {
                $obj = new stdClass();
                $obj->slug = $this->slug;
                $obj->new_version = $remote_version;
                $obj->url = $this->update_path;

                $idx = strpos($this->update_path, '?');
                $s = '?';
                if ($idx !== false) {
                    $s = '&';
                } else {
                    $s = '?';
                }
                $obj->package = $this->update_path . $s . "plugin=" . urlencode($this->slug); // this is the value that will be used to download package
                $transient->response[$this->plugin_slug] = $obj;
            }
//            var_dump($transient);
            return $transient;
        }

        /**
         * Add our self-hosted description to the filter
         *
         * @param boolean $false
         * @param array $action
         * @param object $arg
         * @return bool|object
         */
        public function check_info($false, $action, $arg)
        {
            if ($arg->slug === $this->slug) {
                $information = $this->getRemote_information();
                return $information;
            }
            return false;
        }

        /**
         * Return the remote version
         * @return string $remote_version
         */
        public function getRemote_version()
        {
            $request = wp_remote_post($this->update_path, array('body' => array('action' => 'version', 'plugin' => $this->slug)));

            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return $request['body'];
            }
            return false;
        }


        /**
         * Get information about the remote version
         * @return bool|object
         */
        public function getRemote_information()
        {
            $request = wp_remote_post($this->update_path, array('body' => array('action' => 'info', 'plugin' => $this->slug)));
            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return unserialize($request['body']);
            }
            return false;
        }

        /**
         * Return the status of the plugin licensing
         * @return boolean $remote_license
         */
        public function getRemote_license()
        {
            $request = wp_remote_post($this->update_path, array('body' => array('action' => 'license')));
            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return $request['body'];
            }
            return false;
        }
    }
}

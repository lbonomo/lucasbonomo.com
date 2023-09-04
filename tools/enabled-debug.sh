# Custom local config
FOR_DEBUG='query-monitor'

if [ $LANDO = "ON" ]; then

    # Install debugs tools
    for plugin in $FOR_DEBUG; do
        wp plugin is-active $plugin
        if [ ! 0 -eq $? ]; then
            wp plugin install --activate $plugin
        else
            echo "$plugin it is already activated"
        fi
    done

    # Set debug mode.
    echo -e "\033[0;32mEnabling debug mode\033[0m"
    wp config set WP_DEBUG true --raw
    wp config set WP_DEBUG_LOG true --raw
    wp config set WP_DEBUG_DISPLAY true --raw
    wp config set SCRIPT_DEBUG true --raw
fi

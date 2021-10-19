const { React } = window;

const { PluginDocumentSettingPanel } = window.wp.editPost;

export const examplePlugin = {
  name: 'example-plugin',
  config: {
    icon: '', // // https://developer.wordpress.org/resource/dashicons/#plugins-checked
    render: () => (
      <PluginDocumentSettingPanel
        name="example-plugin"
        title="Example Plugin"
      >
        Example Plugin
      </PluginDocumentSettingPanel>
    ),
  },
  supports: [
    // list of post types
    // ex 'post', 'page'
    'post'
  ],
}
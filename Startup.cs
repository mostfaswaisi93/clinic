using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(MyClinic.Startup))]
namespace MyClinic
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}

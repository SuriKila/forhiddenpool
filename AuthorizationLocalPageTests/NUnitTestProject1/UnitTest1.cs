using NUnit.Framework;
using OpenQA.Selenium;
using System.Threading;

namespace NUnitTestProject1
{
    public class Tests
    {

        private IWebDriver driver;
        private readonly By _autohorButton = By.XPath("//a[text()='Авторизоваться']");
        private readonly By _loginInputButton = By.XPath("//input[@name='login']");
        private readonly By _passwordInputButton = By.XPath("//input[@name='password']");
        private readonly By _autohorGreenButton = By.XPath("//button[@name='do_login']");
        private readonly By _Message = By.XPath("//h1[text()='Whoops, looks like something went wrong.']");

        private const string _excpectedMessage = "Whoops, looks like something went wrong.";
        [SetUp]
        public void Setup()
        {
            driver = new OpenQA.Selenium.Chrome.ChromeDriver();
            driver.Navigate().GoToUrl("http://localhost/QAAuto");
            driver.Manage().Window.Maximize();

        }

        [Test]
        public void Test1()
        {
            var signIn = driver.FindElement(_autohorButton);
            signIn.Click();

            var loginIn = driver.FindElement(_loginInputButton);
            loginIn.SendKeys("Test");

            var passIn = driver.FindElement(_passwordInputButton);
            passIn.SendKeys("Password");


            var greenButton = driver.FindElement(_autohorGreenButton);
            greenButton.Click();

            Thread.Sleep(1000);
            var actualMessage = driver.FindElement(_Message).Text;
            
            Assert.AreEqual(_excpectedMessage,actualMessage,"Page dont have erroMessage");

        }
        [TearDown]
        public void TearDown()
        {
            driver.Quit();


        }
    }
}
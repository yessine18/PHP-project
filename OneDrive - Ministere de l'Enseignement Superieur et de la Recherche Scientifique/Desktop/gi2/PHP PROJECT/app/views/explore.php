<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planets Facts</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <link rel="stylesheet" href="../inc/css/explore.css">
  <body>
    <nav>

      <div class="nav-list">

        <a href="index.php?page=solar_system" class="nav-link"
        >HOME</a>
        
        <a href="#apollo11" class="nav-link" onclick="resetDropdown()"
          >APOLLO 11</a
        >

        <a href="#metrics" class="nav-link" onclick="resetDropdown()"
          >PLANET METRICS</a
        >

        <details>
          <summary class="planets-dropdown fw-300">PLANETS</summary>
          <ul>
            <li onclick="currentSlide(1) ; moveToPlanetCarousel()">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('mercury-info')"
                >Mercury</a
              >
            </li>

            <li onclick="currentSlide(2) ;  moveToPlanetCarousel() ">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('venus-info')"
                >Venus</a
              >
            </li>

            <li onclick="currentSlide(3) ;  moveToPlanetCarousel() ">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('earth-info')"
                >Earth</a
              >
            </li>

            <li onclick="currentSlide(4) ;  moveToPlanetCarousel() ">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('mars-info')"
                >Mars
              </a>
            </li>

            <li onclick="currentSlide(5) ;  moveToPlanetCarousel() ">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('jupiter-info')"
                >Jupiter
              </a>
            </li>

            <li onclick="currentSlide(6) ;  moveToPlanetCarousel() ">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('saturn-info')"
                >Saturn</a
              >
            </li>

            <li onclick="currentSlide(7) ;  moveToPlanetCarousel() ">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('uranus-info')"
                >Uranus</a
              >
            </li>

            <li onclick="currentSlide(8) ;  moveToPlanetCarousel() ">
              <i class="fa-solid fa-shuttle-space"></i>
              <a
                href="#planet-carousel"
                class="nav-link"
                onclick="viewFacts('neptune-info')"
                >Neptune</a
              >
            </li>
          </ul>
        </details>
        <a href="index.php?page=astronomy" class="nav-link"
        >ASTRO-COMMUNITY</a>
      </div>
    </nav>
    <header id="home" onclick="resetDropdown()">
      <div class="carousel" id="planet-carousel">
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Mercury</h2>
            <h3 class="sub-title fw-300 text-yellow">The Smallest Planet</h3>
            <p class="content">
              Mercury is the smallest planet in the Solar System and the closest
              to the Sun. Its orbit around the Sun takes 87.97 Earth days, the
              shortest of all the Sun's planets.Mercury rotates in a way that is
              unique in the Solar System.Its orbital eccentricity is the largest
              of all known planets in the Solar System.
            </p>
          </div>
          <div class="stage">
            <figure class="planet mercury"></figure>
          </div>
        </div>

        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Venus</h2>
            <h3 class="sub-title fw-300 text-yellow">The Hottest Planet</h3>
            <p class="content">
              Second planet from the Sun.It is named after the Roman goddess of
              love and beauty.Venus is a terrestrial planet and is sometimes
              called Earth's "sister planet" because of their similar size,
              mass, proximity to the Sun, and bulk composition.As one of the
              brightest objects in the sky, Venus has been a major fixture in
              human culture for as long as records have existed.
            </p>
          </div>
          <div class="stage">
            <figure class="planet venus"></figure>
          </div>
        </div>

        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Earth</h2>
            <h3 class="sub-title fw-300 text-yellow">The Planet with Life</h3>
            <p class="content">
              Third planet from the Sun and the only astronomical object known
              to harbor life. It is the densest planet in the Solar System. Of
              the four rocky planets, it is the largest and most massive.Earth
              is orbited by one permanent natural satellite, the Moon.Earth's
              atmosphere consists mostly of nitrogen and oxygen.It was formed
              over 4.5 billion years ago.
            </p>
          </div>
          <div class="stage">
            <figure class="planet earth"></figure>
          </div>
        </div>

        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Mars</h2>
            <h3 class="sub-title fw-300 text-yellow">The Red Planet</h3>
            <p class="content">
              Fourth planet from the Sun and the second-smallest planet in the
              Solar System.The days and seasons are comparable to those of
              Earth, because the rotation period as well as the tilt of the
              rotational axis relative to the ecliptic plane are similar. Mars
              is the site of Olympus Mons, the largest volcano and highest known
              mountain on any planet in the Solar System. Mars has two moons,
              Phobos and Deimos, which are small and irregularly shaped.
            </p>
          </div>
          <div class="stage">
            <figure class="planet mars"></figure>
          </div>
        </div>

        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Jupiter</h2>
            <h3 class="sub-title fw-300 text-yellow">The Gas Giant</h3>
            <p class="content">
              Fifth planet from the Sun and the largest in the Solar System.
              Jupiter is the third brightest natural object in the Earth's night
              sky after the Moon and Venus.It is a gas giant with a mass more
              than two and a half times that of all the other planets in the
              Solar System combined. There is a Great Red Spot, a giant storm
              known to have existed since at least the 17th century when
              telescopes first saw it.
            </p>
          </div>
          <div class="stage">
            <figure class="planet jupiter"></figure>
          </div>
        </div>

        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Saturn</h2>
            <h3 class="sub-title fw-300 text-yellow">The Ring Planet</h3>
            <p class="content">
              Sixth planet from the Sun and the second-largest in the Solar
              System, after Jupiter. The planet's most notable feature is its
              prominent ring system, which is composed mainly of ice particles,
              with a smaller amount of rocky debris and dust. Titan, Saturn's
              largest moon and the second largest in the Solar System, is larger
              than the planet Mercury, although less massive, and is the only
              moon in the Solar System to have a substantial atmosphere.
            </p>
          </div>
          <div class="stage">
            <figure class="saturn"></figure>
          </div>
        </div>

        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Uranus</h2>
            <h3 class="sub-title fw-300 text-yellow">The Coldest Planet</h3>
            <p class="content">
              Seventh planet from the Sun and has the third-largest diameter in
              our solar system.Uranus was discovered in 1781 by astronomer
              William Herschel, although he originally thought it was either a
              comet or a star.Uranus is similar in composition to Neptune, and
              both have bulk chemical compositions which differ from that of the
              larger gas giants Jupiter and Saturn.
            </p>
          </div>
          <div class="stage">
            <figure class="planet uranus"></figure>
          </div>
        </div>

        <div class="slide">
          <div class="description slideUp">
            <h2 class="title">Neptune</h2>
            <h3 class="sub-title fw-300 text-yellow">The Outermost Planet</h3>
            <p class="content">
              Eighth planet from the Sun. In the Solar System, it is the
              fourth-largest planet by diameter, the third-most-massive planet,
              and the densest giant planet. It is 17 times the mass of Earth,
              slightly more massive than its near-twin Uranus. Neptune is denser
              and physically smaller than Uranus because its greater mass causes
              more gravitational compression of its atmosphere. It is referred
              to as as one of the solar system's two ice giant planets.
            </p>
          </div>
          <div class="stage">
            <figure class="planet neptune"></figure>
          </div>
        </div>
      </div>
    </header>

    <!-- Solar System -->

    <!-- apollo 11 -->

    <section
      class="apollo-section flex-center"
      id="apollo11"
      onclick="resetDropdown()"
    >
      <div class="space-event">
        <div class="space-item">
          <img src="../inc/ressources/apollo-2.jpg" class="space-image" />
        </div>
        <div class="space-item">
          <img src="../inc/ressources/apollo-1.jpg" class="space-image" />
        </div>
        <div class="space-item space-info">
          <h3 class="text-yellow">Apollo 11</h3>
          <p>
            Apollo 11 was the American spaceflight that first landed humans on
            the Moon. Commander Neil Armstrong and lunar module pilot Buzz
            Aldrin landed the Apollo Lunar Module Eagle on July 20, 1969 and
            Armstrong became the first person to step onto the Moon's surface
            six hours and 39 minutes later, on July 21 at 02:56 UTC.
          </p>
        </div>
        <div class="space-item">
          <img src="../inc/ressources/apollo-3.jpg" class="space-image" />
        </div>
        <div class="space-item">
          <img src="../inc/ressources/apollo-4.jpg" class="space-image" />
        </div>
        <div class="space-item">
          <img src="../inc/ressources/apollo-5.jpg" class="space-image" />
        </div>
      </div>
    </section>

    <!-- metrics -->

    <section class="flex-center" id="metrics" onclick="resetDropdown()">
      <div class="planet-metric">
        <div class="planet-card">
          <div class="planet-icon flex-center">
            <div class="planet-letter seven-letter">M</div>
            <div class="planet-letter seven-letter">E</div>
            <div class="planet-letter seven-letter">R</div>
            <div class="planet-letter seven-letter">C</div>
            <div class="planet-letter seven-letter">U</div>
            <div class="planet-letter seven-letter">R</div>
            <div class="planet-letter seven-letter">Y</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>0</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>3.7m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>1407.6 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>88.0 Days</p>
            </div>
          </div>
        </div>
        <div class="planet-card">
          <div class="planet-icon flex-center">
            <div class="planet-letter five-letter">V</div>
            <div class="planet-letter five-letter">E</div>
            <div class="planet-letter five-letter">N</div>
            <div class="planet-letter five-letter">U</div>
            <div class="planet-letter five-letter">S</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>0</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>8.9m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>5832.5 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>224.7 Days</p>
            </div>
          </div>
        </div>
        <div class="planet-card">
          <div class="planet-icon flex-center">
            <div class="planet-letter five-letter">E</div>
            <div class="planet-letter five-letter">A</div>
            <div class="planet-letter five-letter">R</div>
            <div class="planet-letter five-letter">T</div>
            <div class="planet-letter five-letter">H</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>1</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>9.8m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>23.9 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>365.2 Days</p>
            </div>
          </div>
        </div>
        <div class="planet-card">
          <div class="planet-icon flex-center">
            <div class="planet-letter four-letter">M</div>
            <div class="planet-letter four-letter">A</div>
            <div class="planet-letter four-letter">R</div>
            <div class="planet-letter four-letter">S</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>2</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>3.7m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>24.6 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>687.0 Days</p>
            </div>
          </div>
        </div>
        <div class="planet-card">
          <div class="planet-icon flex-center">
            <div class="planet-letter seven-letter">J</div>
            <div class="planet-letter seven-letter">U</div>
            <div class="planet-letter seven-letter">P</div>
            <div class="planet-letter seven-letter">I</div>
            <div class="planet-letter seven-letter">T</div>
            <div class="planet-letter seven-letter">E</div>
            <div class="planet-letter seven-letter">R</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>95</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>23.1m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>9.9 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>4331 Days</p>
            </div>
          </div>
        </div>
        <div class="planet-card">
          <div class="planet-icon flex-center saturn-icon">
            <div class="planet-letter six-letter">S</div>
            <div class="planet-letter six-letter">A</div>
            <div class="planet-letter six-letter">T</div>
            <div class="planet-letter six-letter">U</div>
            <div class="planet-letter six-letter">R</div>
            <div class="planet-letter six-letter">N</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>146</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>9.0m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>10.7 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>10,747 Days</p>
            </div>
          </div>
        </div>
        <div class="planet-card">
          <div class="planet-icon flex-center">
            <div class="planet-letter six-letter">U</div>
            <div class="planet-letter six-letter">R</div>
            <div class="planet-letter six-letter">A</div>
            <div class="planet-letter six-letter">N</div>
            <div class="planet-letter six-letter">U</div>
            <div class="planet-letter six-letter">S</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>27</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>8.7m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>17.2 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>30,589 Days</p>
            </div>
          </div>
        </div>
        <div class="planet-card">
          <div class="planet-icon flex-center">
            <div class="planet-letter seven-letter">N</div>
            <div class="planet-letter seven-letter">E</div>
            <div class="planet-letter seven-letter">P</div>
            <div class="planet-letter seven-letter">T</div>
            <div class="planet-letter seven-letter">U</div>
            <div class="planet-letter seven-letter">N</div>
            <div class="planet-letter seven-letter">E</div>
          </div>
          <div class="metrics">
            <div class="moons">
              <h5>Moons</h5>
              <p>14</p>
            </div>
            <div class="gravity">
              <h5>Gravity</h5>
              <p>11.0m/s<sup>2</sup></p>
            </div>

            <div class="rotation">
              <h5>Rotation Period</h5>
              <p>16.1 hours</p>
            </div>

            <div class="orbital">
              <h5>Orbital period</h5>
              <p>59,800 Days</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer onclick="resetDropdown()">
      <div class="footer-content">
        <div class="footer-links-group fw-300">
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(1)"
            >Mercury</a
          >
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(2)"
            >Venus</a
          >
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(3)"
            >Earth</a
          >
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(4)"
            >Mars</a
          >
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(5)"
            >Jupiter</a
          >
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(6)"
            >Saturn</a
          >
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(7)"
            >Uranus</a
          >
          <a
            href="#planet-carousel"
            class="footer-link"
            onclick="currentSlide(8)"
            >Neptune</a
          >
        </div>
      </div>
    </footer>
    <script src="../inc/js/explore.js"></script>
  </body>
</html>

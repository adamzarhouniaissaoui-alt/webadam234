// Navigation Toggle
document.addEventListener("DOMContentLoaded", () => {
  const navToggle = document.getElementById("navToggle")
  const navMenu = document.getElementById("navMenu")

  if (navToggle && navMenu) {
    navToggle.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Close mobile menu when clicking on a link
  const navLinks = document.querySelectorAll(".nav-link")
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("active")
    })
  })

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })

  // Header background on scroll
  const header = document.querySelector(".header")
  window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
      header.style.background = "rgba(15, 15, 15, 0.98)"
    } else {
      header.style.background = "rgba(15, 15, 15, 0.95)"
    }
  })

  // Scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate")
      }
    })
  }, observerOptions)

  // Add scroll animation to cards
  const animateElements = document.querySelectorAll(
    ".model-card, .feature-card, .use-case-card, .pricing-card, .testimonial-card, .blog-card, .product-card, .gallery-item",
  )
  animateElements.forEach((el) => {
    el.classList.add("scroll-animate")
    observer.observe(el)
  })

  // Counter animation for stats
  const stats = document.querySelectorAll(".stat-number")
  const statsObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounter(entry.target)
          statsObserver.unobserve(entry.target)
        }
      })
    },
    { threshold: 0.5 },
  )

  stats.forEach((stat) => {
    statsObserver.observe(stat)
  })

  function animateCounter(element) {
    const target = element.textContent
    const isPercentage = target.includes("%")
    const isPlus = target.includes("+")
    const numericValue = Number.parseFloat(target.replace(/[^\d.]/g, ""))

    let current = 0
    const increment = numericValue / 50
    const timer = setInterval(() => {
      current += increment
      if (current >= numericValue) {
        current = numericValue
        clearInterval(timer)
      }

      let displayValue = Math.floor(current)
      if (target.includes("M")) {
        displayValue = (current / 1000000).toFixed(1) + "M"
      } else if (target.includes("B")) {
        displayValue = (current / 1000000000).toFixed(1) + "B"
      } else if (isPercentage) {
        displayValue = current.toFixed(1) + "%"
      }

      if (isPlus && !isPercentage) {
        displayValue += "+"
      }

      element.textContent = displayValue
    }, 20)
  }

  initializeGallery()

  initializeContactForm()

  initializeProducts()
})

// FAQ Toggle Function
function toggleFAQ(button) {
  const faqItem = button.parentElement
  const answer = faqItem.querySelector(".faq-answer")
  const isActive = button.classList.contains("active")

  // Close all other FAQ items
  document.querySelectorAll(".faq-question").forEach((q) => {
    q.classList.remove("active")
    q.parentElement.querySelector(".faq-answer").classList.remove("active")
  })

  // Toggle current item
  if (!isActive) {
    button.classList.add("active")
    answer.classList.add("active")
  }
}

function initializeGallery() {
  const filterButtons = document.querySelectorAll(".filter-btn")
  const galleryItems = document.querySelectorAll(".gallery-item")
  const loadMoreBtn = document.querySelector(".gallery-load-more .btn-outline")

  // Filter functionality
  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      // Remove active class from all buttons
      filterButtons.forEach((btn) => btn.classList.remove("active"))
      // Add active class to clicked button
      button.classList.add("active")

      const filter = button.getAttribute("data-filter")

      galleryItems.forEach((item) => {
        if (filter === "all" || item.getAttribute("data-category") === filter) {
          item.style.display = "block"
          item.style.animation = "fadeInUp 0.6s ease-out"
        } else {
          item.style.display = "none"
        }
      })
    })
  })

  // Load more functionality (simulated)
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", (e) => {
      e.preventDefault()
      const originalText = loadMoreBtn.innerHTML
      loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cargando...'

      setTimeout(() => {
        loadMoreBtn.innerHTML = originalText
        alert("En una implementación real, esto cargaría más contenido de la API.")
      }, 2000)
    })
  }

  // Gallery item interactions
  galleryItems.forEach((item) => {
    item.addEventListener("click", () => {
      // Simulate opening modal or detailed view
      const title = item.querySelector(".gallery-info h4")?.textContent || "Contenido"
      alert(`Abriendo vista detallada de: ${title}`)
    })
  })
}

function initializeContactForm() {
  const contactForm = document.getElementById("contactForm")
  const formStatus = document.getElementById("formStatus")

  if (contactForm) {
    contactForm.addEventListener("submit", async (e) => {
      e.preventDefault()

      const formData = new FormData(contactForm)
      const submitBtn = contactForm.querySelector(".form-submit")
      const originalText = submitBtn.innerHTML

      // Show loading state
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...'
      submitBtn.disabled = true

      try {
        const response = await fetch("api/contact.php", {
          method: "POST",
          body: formData,
        })

        const result = await response.json()

        if (result.success) {
          // Show success message
          formStatus.className = "form-status success"
          formStatus.textContent = result.message
          formStatus.style.display = "block"

          // Reset form
          contactForm.reset()
        } else {
          // Show error message
          formStatus.className = "form-status error"
          formStatus.textContent = result.message
          formStatus.style.display = "block"
        }
      } catch (error) {
        console.log("[v0] Contact form error:", error)
        // Show error message
        formStatus.className = "form-status error"
        formStatus.textContent = "Error al enviar el mensaje. Por favor, inténtalo de nuevo."
        formStatus.style.display = "block"
      } finally {
        // Restore button
        submitBtn.innerHTML = originalText
        submitBtn.disabled = false

        // Hide status message after 5 seconds
        setTimeout(() => {
          formStatus.style.display = "none"
        }, 5000)
      }
    })
  }

  // Form validation
  const requiredFields = contactForm?.querySelectorAll("[required]")
  requiredFields?.forEach((field) => {
    field.addEventListener("blur", validateField)
    field.addEventListener("input", clearFieldError)
  })

  function validateField(e) {
    const field = e.target
    const value = field.value.trim()

    if (!value) {
      showFieldError(field, "Este campo es obligatorio")
    } else if (field.type === "email" && !isValidEmail(value)) {
      showFieldError(field, "Por favor, introduce un email válido")
    } else {
      clearFieldError({ target: field })
    }
  }

  function showFieldError(field, message) {
    field.style.borderColor = "#ef4444"
    let errorMsg = field.parentNode.querySelector(".field-error")
    if (!errorMsg) {
      errorMsg = document.createElement("div")
      errorMsg.className = "field-error"
      errorMsg.style.color = "#ef4444"
      errorMsg.style.fontSize = "0.8rem"
      errorMsg.style.marginTop = "0.25rem"
      field.parentNode.appendChild(errorMsg)
    }
    errorMsg.textContent = message
  }

  function clearFieldError(e) {
    const field = e.target
    field.style.borderColor = "#27272a"
    const errorMsg = field.parentNode.querySelector(".field-error")
    if (errorMsg) {
      errorMsg.remove()
    }
  }

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
  }
}

function initializeProducts() {
  const productButtons = document.querySelectorAll(".product-btn")
  const cart = JSON.parse(localStorage.getItem("aiPlatformCart")) || []

  productButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault()

      const productCard = button.closest(".product-card")
      const productName = productCard.querySelector(".product-title").textContent
      const productPrice = productCard.querySelector(".price").textContent

      // Add to cart
      const product = {
        id: Date.now(),
        name: productName,
        price: productPrice,
        quantity: 1,
      }

      cart.push(product)
      localStorage.setItem("aiPlatformCart", JSON.stringify(cart))
      localStorage.setItem("aiPlatformCartId", "cart-" + Date.now())

      // Show success feedback
      const originalText = button.innerHTML
      button.innerHTML = '<i class="fas fa-check"></i> ¡Añadido!'
      button.style.background = "#10b981"

      setTimeout(() => {
        button.innerHTML = originalText
        button.style.background = ""
        // Redirect to checkout
        window.location.href = "checkout.html"
      }, 1500)

      updateCartCounter()
    })
  })

  function updateCartCounter() {
    const cartCounter = document.querySelector(".cart-counter")
    if (cartCounter) {
      cartCounter.textContent = cart.length
      cartCounter.style.display = cart.length > 0 ? "block" : "none"
    }
  }

  updateCartCounter()
}

// Form handling (you can extend this for actual form submissions)
document.querySelectorAll(".btn-primary, .btn-outline").forEach((button) => {
  if (button.textContent.includes("Comenzar") || button.textContent.includes("Gratis")) {
    button.addEventListener("click", (e) => {
      e.preventDefault()
      alert(
        "¡Gracias por tu interés! Esta es una demo. En una implementación real, esto te llevaría al proceso de registro.",
      )
    })
  }
})

// Add loading states to buttons
document.querySelectorAll("button").forEach((button) => {
  // Skip buttons that already have specific handlers
  if (
    button.classList.contains("filter-btn") ||
    button.classList.contains("product-btn") ||
    button.classList.contains("form-submit") ||
    button.classList.contains("faq-question")
  ) {
    return
  }

  button.addEventListener("click", function () {
    if (!this.classList.contains("loading")) {
      const originalText = this.innerHTML
      this.classList.add("loading")
      this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cargando...'

      setTimeout(() => {
        this.classList.remove("loading")
        this.innerHTML = originalText
      }, 2000)
    }
  })
})

// Add some interactive effects
document.querySelectorAll(".model-card, .feature-card, .use-case-card, .product-card").forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-10px) scale(1.02)"
  })

  card.addEventListener("mouseleave", function () {
    this.style.transform = "translateY(0) scale(1)"
  })
})

// Parallax effect for hero background
window.addEventListener("scroll", () => {
  const scrolled = window.pageYOffset
  const heroBackground = document.querySelector(".hero-background")
  if (heroBackground) {
    heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`
  }
})

function updateSEOTags(page) {
  const titles = {
    inicio: "AI Platform - Plataforma de Inteligencia Artificial",
    modelos: "Modelos de IA Avanzados - GPT-5, DALL-E 3 | AI Platform",
    productos: "Productos de IA - Chatbots, Generadores | AI Platform",
    galeria: "Galería Social - Creaciones con IA | AI Platform",
    contacto: "Contacto - AI Platform",
  }

  const descriptions = {
    inicio: "Plataforma líder de IA con modelos GPT-5, DALL-E 3, Whisper V3. API ultra rápida, seguridad empresarial.",
    modelos: "Accede a los modelos de IA más avanzados: GPT-5 Turbo, DALL-E 3, Whisper V3 y CodeGen Pro.",
    productos: "Soluciones completas de IA: Chatbots inteligentes, generadores de imágenes y analytics avanzados.",
    galeria: "Descubre creaciones increíbles hechas con IA por nuestra comunidad de usuarios.",
    contacto: "Contacta con nuestro equipo de expertos en IA. Soporte 24/7 y consultoría personalizada.",
  }

  if (titles[page]) {
    document.title = titles[page]

    const metaDescription = document.querySelector('meta[name="description"]')
    if (metaDescription) {
      metaDescription.setAttribute("content", descriptions[page])
    }
  }
}

const sectionObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const sectionId = entry.target.id
        if (sectionId) {
          updateSEOTags(sectionId)

          // Update URL hash without scrolling
          if (history.pushState) {
            history.pushState(null, null, `#${sectionId}`)
          }
        }
      }
    })
  },
  { threshold: 0.5 },
)

// Observe main sections
document.querySelectorAll("section[id]").forEach((section) => {
  sectionObserver.observe(section)
})

// Add typing effect to hero title (optional enhancement)
function typeWriter(element, text, speed = 100) {
  let i = 0
  element.innerHTML = ""

  function type() {
    if (i < text.length) {
      element.innerHTML += text.charAt(i)
      i++
      setTimeout(type, speed)
    }
  }

  type()
}

function trackEvent(category, action, label) {
  console.log(`[Analytics] ${category} - ${action} - ${label}`)

  // En una implementación real, aquí enviarías datos a Google Analytics
  // gtag('event', action, {
  //   event_category: category,
  //   event_label: label
  // })
}

// Track user interactions
document.addEventListener("click", (e) => {
  const target = e.target.closest("button, a")
  if (target) {
    const text = target.textContent.trim()
    const section = target.closest("section")?.id || "unknown"
    trackEvent("User Interaction", "Click", `${section}: ${text}`)
  }
})

// Track form submissions
document.addEventListener("submit", (e) => {
  const form = e.target
  const formId = form.id || "unknown-form"
  trackEvent("Form", "Submit", formId)
})

// Track scroll depth
let maxScroll = 0
window.addEventListener("scroll", () => {
  const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100)
  if (scrollPercent > maxScroll) {
    maxScroll = scrollPercent
    if (maxScroll % 25 === 0) {
      // Track every 25%
      trackEvent("Scroll Depth", "Scroll", `${maxScroll}%`)
    }
  }
})

// Uncomment to enable typing effect
// const heroTitle = document.querySelector('.hero-title');
// if (heroTitle) {
//     const originalText = heroTitle.textContent;
//     typeWriter(heroTitle, originalText, 50);
// }

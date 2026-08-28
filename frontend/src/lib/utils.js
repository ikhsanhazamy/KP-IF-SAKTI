import { clsx } from "clsx";
import { twMerge } from "tailwind-merge"

export function cn(...inputs) {
  return twMerge(clsx(inputs));
}

/**
 * Normalizes phone numbers to standard WhatsApp wa.me URL with country code
 * e.g., '081234567890' -> 'https://wa.me/6281234567890'
 * e.g., '+62 812-3456-7890' -> 'https://wa.me/6281234567890'
 */
export function formatWhatsAppUrl(phone) {
  if (!phone) return "";
  const cleaned = String(phone).replace(/[^0-9]/g, "");
  if (!cleaned) return "";

  if (cleaned.startsWith("0")) {
    return `https://wa.me/62${cleaned.slice(1)}`;
  }
  if (cleaned.startsWith("62")) {
    return `https://wa.me/${cleaned}`;
  }
  return `https://wa.me/${cleaned}`;
}

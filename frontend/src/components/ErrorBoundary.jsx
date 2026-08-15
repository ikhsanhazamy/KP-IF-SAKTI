import React from "react";

class ErrorBoundary extends React.Component {
  constructor(props) {
    super(props);
    this.state = { hasError: false, error: null };
  }

  static getDerivedStateFromError(error) {
    return { hasError: true, error };
  }

  componentDidCatch(error, errorInfo) {
    console.error("[ErrorBoundary]", error, errorInfo);
  }

  handleReload = () => {
    this.setState({ hasError: false, error: null });
    window.location.reload();
  };

  render() {
    if (this.state.hasError) {
      return (
        <div className="min-h-screen bg-[#f6f8f7] flex items-center justify-center px-4">
          <div className="text-center max-w-md">
            <div className="text-6xl mb-4 select-none">⚠️</div>
            <h1 className="text-2xl font-semibold text-gray-900 mb-3">
              Terjadi Kesalahan
            </h1>
            <p className="text-gray-500 mb-6 leading-relaxed text-sm">
              Maaf, terjadi masalah pada aplikasi. Silakan coba muat ulang halaman.
            </p>
            <button
              onClick={this.handleReload}
              className="inline-flex items-center gap-2 bg-[#1f7a4d] hover:bg-[#17633f] text-white font-semibold px-6 py-3 rounded-2xl shadow-md hover:shadow-lg transition duration-200"
            >
              Muat Ulang
            </button>
          </div>
        </div>
      );
    }

    return this.props.children;
  }
}

export default ErrorBoundary;
